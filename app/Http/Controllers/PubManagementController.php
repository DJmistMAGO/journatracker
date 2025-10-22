<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Media;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusUpdateNotification;
use App\Notifications\StatusChangedNotification;

class PubManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        // Articles
        $articles = Article::with('user')
            ->whereIn('status', ['Draft', 'Approved', 'Scheduled', 'For Publish', 'Revision'])
            ->when($search, fn($query) => $query->where('title', 'like', "%{$search}%"))
            ->when($status, fn($query) => $query->where('status', $status))
            ->orderByDesc('date_submitted')
            ->get();

        // Media
        $media = Media::with('user')
            ->whereIn('status', ['Draft', 'Approved', 'Scheduled', 'For Publish', 'Revision'])
            ->when($search, fn($query) => $query->where('title', 'like', "%{$search}%"))
            ->when($status, fn($query) => $query->where('status', $status))
            ->orderByDesc('date_submitted')
            ->get();

        // Merge & sort by submission date
        $items = $articles
            ->concat($media)
            ->sortByDesc('date_submitted')
            ->values();

        return view('spj-content.publication-management.index', compact('items'));
    }

    public function show($type, $id)
    {
        $item = $this->getItemByType($type, $id);

        return view('spj-content.publication-management.show', [
            'item' => $item,
            'type' => strtolower($type),
        ]);
    }

    public function updateStatus($type, $id, Request $request)
    {
        $item = $this->getItemByType($type, $id);

        // Check if unpublish is requested via a special status
        if ($request->has('unpublish')) {
            if ($item->status === 'Published' || $item->status === 'Scheduled') {
                $item->status = 'Draft'; // or 'Draft' if you prefer
                $item->publish_at = null;
                $item->date_publish = null;
                $item->save();

                return back()->with('success', ucfirst($type) . ' unpublished successfully.');
            }

            return back()->with('error', ucfirst($type) . ' cannot be unpublished now.');
        }

        // Validate for normal status updates
        $validated = $request->validate([
            'status' => 'required|in:publish_now,schedule_later,Revision,Rejected',
            'date_publish' => 'nullable|date',
            'time_publish' => 'nullable|date_format:H:i',
            'remarks' => 'nullable|string|max:1000',
        ]);

        if ($validated['status'] === 'publish_now') {
            $item->status = 'Published';
            $item->date_publish = Carbon::now()->format('Y-m-d');
            $item->publish_at = Carbon::now();
            $item->remarks = null;
        } elseif ($validated['status'] === 'schedule_later') {
            $item->status = 'Scheduled';
            $item->date_publish = $validated['date_publish'] ?? null;
            $item->publish_at = $validated['time_publish']
                ? Carbon::parse($validated['date_publish'] . ' ' . $validated['time_publish'])
                : null;
            $item->remarks = null;
        } elseif (in_array($validated['status'], ['Revision', 'Rejected'])) {
            $item->status = $validated['status'];
            $item->remarks = $validated['remarks'] ?? null;
            $item->date_publish = null;
            $item->publish_at = null;
        }

        $item->save();

        // Notify user (optional)
        if ($item->user) {
            $item->user->notify(new StatusChangedNotification($item));
            if ($item->user->email) {
                Mail::to($item->user->email)->queue(
                    new StatusUpdateNotification(
                        $item->user->penname ?? $item->user->name,
                        $item->type,
                        $item->title ?? 'Untitled',
                        $item->status,
                        $item->remarks,
                        $item->date_publish,
                        $item->publish_at
                    )
                );
            }
        }

        return back()->with('success', ucfirst($type) . ' status updated successfully.');
    }

    /**
     * Helper to fetch Article or Media by type
     */
    private function getItemByType($type, $id)
    {
        $type = strtolower(trim($type));
        if ($type === 'article') {
            return Article::with('user')->findOrFail($id);
        } elseif ($type === 'media') {
            return Media::with('user')->findOrFail($id);
        } else {
            abort(404, 'Invalid type');
        }
    }

    public function unpublish($type, $id)
    {
        $item = $this->getItemByType($type, $id);

        // Only allow unpublishing if currently Published or Scheduled
        if (in_array($item->status, ['Published', 'Scheduled'])) {
            // Reset publish info
            $item->status = 'Draft'; // or whatever default prior state should be
            $item->publish_at = null;
            $item->date_publish = null;
            $item->remarks = null;

            $item->save();

            // // Notify user
            // if ($item->user) {
            //     $item->user->notify(new StatusChangedNotification($item));

            //     if ($item->user->email) {
            //         Mail::to($item->user->email)->queue(
            //             new StatusUpdateNotification(
            //                 $item->user->penname ?? $item->user->name,
            //                 $item->type,
            //                 $item->title ?? 'Untitled',
            //                 $item->status,
            //                 $item->remarks,
            //                 $item->date_publish,
            //                 $item->publish_at
            //             )
            //         );
            //     }
            // }

            return back()->with('success', ucfirst($type) . ' has been unpublished successfully.');
        }

        return back()->with('error', 'This ' . $type . ' cannot be unpublished now.');
    }

    /**
     * Reschedule a scheduled article
     */
    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'publish_date' => 'required|date',
            'publish_time' => 'required|date_format:H:i',
        ]);

        $article = Article::findOrFail($id);

        if ($article->status === 'Scheduled') {
            $publishDateTime = Carbon::parse($request->publish_date . ' ' . $request->publish_time);

            $article->publish_at = $publishDateTime;
            $article->save();

            return back()->with('success', 'Publishing rescheduled to ' . $publishDateTime->format('M d, Y h:i A'));
        }

        return back()->with('error', 'This article cannot be rescheduled.');
    }

    public function editArticle($id)
    {
        $article = Article::findOrFail($id);
        return view('spj-content.article-management.edit', [
            'article' => $article,
            'fromPublication' => true,
        ]);
    }

    public function editMedia($id)
    {
        $media = Media::findOrFail($id);
        return view('spj-content.media-management.edit', [
            'media' => $media,
            'fromPublication' => true,
        ]);
    }
}
