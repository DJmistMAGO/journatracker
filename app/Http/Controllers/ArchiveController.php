<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;
use App\Models\PubManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $auth_id = $user->id;
        $user_role = $user->getRoleNames()->first();

        $search = $request->input('search'); // search input
        $status = $request->input('status'); // status filter from select input

        // Default allowed statuses
        $allowedStatuses = ['Published', 'Rejected'];

        if ($status && in_array($status, $allowedStatuses)) {
            $filterStatus = [$status];
        } else {
            $filterStatus = $allowedStatuses; // fallback to both if none selected
        }

        if ($user_role === 'admin' || $user_role === 'teacher') {
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
        } else {
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

        // Merge articles and media
        $items = $articles
            ->concat($media)
            ->sortByDesc('date_publish')
            ->values();

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