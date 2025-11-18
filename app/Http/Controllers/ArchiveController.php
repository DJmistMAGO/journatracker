<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;
use App\Models\PubManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $auth_id = $user->id;
        $user_role = $user->getRoleNames()->first();

        $search = $request->input('search');
        $status = $request->input('status');

        // Teacher filters
        $teacherPosition = $user->position ?? null;
        $teacherSubject = $user->subject_specialization ?? null;

        $allowedStatuses = ['Published', 'Rejected'];

        $filterStatus = $status && in_array($status, $allowedStatuses) ? [$status] : $allowedStatuses;

        if ($user_role === 'admin') {
            // Admin sees all, no restrictions
            $articles = Article::with('user')
                ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
                ->whereIn('status', $filterStatus)
                ->orderBy('date_publish', 'desc')
                ->get();

            $media = Media::with('user')
                ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
                ->whereIn('status', $filterStatus)
                ->orderBy('date_publish', 'desc')
                ->get();
        } elseif ($user_role === 'teacher') {
            // Teachers ONLY see items where student has same position AND subject specialization
            $articles = Article::with('user')
                ->whereHas('user', function ($q) use ($teacherPosition, $teacherSubject) {
                    $q->where('position', $teacherPosition)->where('subject_specialization', $teacherSubject);
                })
                ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
                ->whereIn('status', $filterStatus)
                ->orderBy('date_publish', 'desc')
                ->get();

            $media = Media::with('user')
                ->whereHas('user', function ($q) use ($teacherPosition, $teacherSubject) {
                    $q->where('position', $teacherPosition)->where('subject_specialization', $teacherSubject);
                })
                ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
                ->whereIn('status', $filterStatus)
                ->orderBy('date_publish', 'desc')
                ->get();
        } else {
            // Students only see their own entries
            $articles = Article::with('user')
                ->where('user_id', $auth_id)
                ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
                ->whereIn('status', $filterStatus)
                ->orderBy('date_publish', 'desc')
                ->get();

            $media = Media::with('user')
                ->where('user_id', $auth_id)
                ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
                ->whereIn('status', $filterStatus)
                ->orderBy('date_publish', 'desc')
                ->get();
        }

        // Merge & sort
        $merged = $articles
            ->concat($media)
            ->sortByDesc('date_publish')
            ->values();

        // Manual Pagination
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $items = new LengthAwarePaginator($currentItems, $merged->count(), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('spj-content.archive.index', compact('items'));
    }

    public function show($type, $id)
    {
        $item = $this->getItemByType($type, $id);

        return view('spj-content.publication-management.show', [
            'item' => $item,
            'type' => strtolower($type),
        ]);
    }

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
}
