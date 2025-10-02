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
    public function index()
    {
        // Map articles
        $articles = Article::with('user')
            ->whereIn('status', ['Approved', 'Scheduled', 'Published'])
            ->orderBy('date_submitted', 'desc')
            ->get()
            ->map(function ($item) {
                $item->type;
                return $item;
            });

        // Map media
        $media = Media::with('user')
            ->where('status', ['Approved', 'Scheduled', 'Published'])
            ->orderBy('date_submitted', 'desc')
            ->get()
            ->map(function ($item) {
                $item->type;
                return $item;
            });

        // Merge & sort
        $items = $articles
            ->concat($media)
            ->sortByDesc('date_submitted')
            ->values();

        return view('spj-content.publication-management.index', compact('items'));
    }

    public function show($type, $id)
    {
        $type = strtolower(trim($type));

        if ($type === 'article') {
            $item = Article::findOrFail($id);
        } elseif ($type === 'media') {
            $item = Media::findOrFail($id);
        } else {
            abort(404, 'Invalid type.');
        }

        return view('spj-content.publication-management.show', ['item' => $item, 'type' => $type]);
    }

    public function updateStatus($type, $id, Request $request)
    {
        // Find the correct item
        if ($type === 'Article') {
            $item = Article::with('user')->findOrFail($id);
        } elseif ($type === 'Media') {
            $item = Media::with('user')->findOrFail($id);
        } else {
            abort(404, 'Invalid type');
        }

        // Validate request
        $validated = $request->validate([
            'status' => 'required|in:Published,Revision,Rejected', // Draft is default
            'date_publish' => 'required_if:status,Published|nullable|date',
            'remarks' => 'required_if:status,Revision,Rejected|nullable|string|max:1000',
        ]);

        $item->status = $validated['status'];
        $item->date_publish = $validated['date_publish'] ?? null;
        $item->remarks = $validated['remarks'] ?? null;
        $item->save();

        $item->author->notify(new StatusChangedNotification($item));

        // // Send email to author
        if ($item->user && $item->user->email) {
            Mail::to($item->user->email)->queue(
                new StatusUpdateNotification(
                    $item->user->penname, // or $item->user->name if you defined accessor
                    $item->type, // Article or Media
                    $item->title ?? 'Untitled',
                    $item->status,
                    $item->remarks ?? null,
                    $item->date_publish
                )
            );
        }

        return redirect()
            ->route('publication-management.index')
            ->with('success', ucfirst($type) . ' status updated successfully.');
    }

    // publish function (if needed in the future)
    public function publish(Request $request, $id)
    {
        $request->validate([
            'publish_date' => 'required|date',
            'publish_time' => 'required|date_format:H:i',
        ]);

        $article = Article::findOrFail($id);

        // Combine date + time
        $publishDateTime = \Carbon\Carbon::parse($request->publish_date . ' ' . $request->publish_time);

        $article->publish_at = $publishDateTime;
        $article->status = 'Scheduled'; // stays approved until actual publish
        $article->save();

        return back()->with(
            'success',
            'Article scheduled for publishing on ' . $publishDateTime->format('M d, Y h:i A')
        );
    }

    public function unpublish($id)
    {
        $article = Article::findOrFail($id);

        // Only allow if still Approved but not yet Published
        if ($article->status === 'Approved' && $article->publish_at && $article->publish_at > Carbon::now()) {
            $article->publish_at = null; // clear schedule
            $article->status = 'Approved'; // stays approved but unscheduled
            $article->save();

            return back()->with('success', 'Publishing schedule canceled.');
        }

        return back()->with('error', 'This article cannot be unpublished now.');
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
}
