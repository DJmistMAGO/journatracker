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
	public function index()
	{
		$user = Auth::user();
		$auth_id = $user->id;

		// Get first role of the user
		$user_role = $user->getRoleNames()->first();

		// Helper function to map items
		$mapItems = function ($items, $type) {
			return $items->map(function ($item) use ($type) {
				return (object) [
					'id' => $item->id,
					'title' => $type === 'Article' ? $item->title_article : $item->title,
					'type' => $type,
					'user' => $item->user,
					'status' => $item->status,
					'date' => $item->date_publish,
					'created_at' => $item->created_at,
				];
			});
		};

		if ($user_role === "admin" || $user_role === "eic") {

			$articles = $mapItems(Article::with('user')
				->where('status', 'Published')
				->orderBy('created_at', 'desc')
				->get(), 'Article');

			$media = $mapItems(Media::with('user')
				->where('status', 'Published')
				->orderBy('created_at', 'desc')
				->get(), 'Media');
		} else {
			$articles = $mapItems(Article::with('user')
				->where('user_id', $auth_id)
				->where('status', 'Published')
				->orderBy('created_at', 'desc')
				->get(), 'Article');

			$media = $mapItems(Media::with('user')
				->where('user_id', $auth_id)
				->where('status', 'Published')
				->orderBy('created_at', 'desc')
				->get(), 'Media');
		}

		// Merge articles and media
		$items = $articles->merge($media)->sortByDesc('date')->values();

		return view("spj-content.archive.index", compact('items'));
	}

	public function view($type, $id, Request $request)
{
    $sessionKey = "viewed_{$type}_{$id}";

    if ($request->session()->has($sessionKey)) {
        // Already viewed → skip increment
        return;
    }

    if ($type === 'article') {
        $article = Article::findOrFail($id);

        $article->publication()->firstOrCreate([]);
        $article->publication()->increment('views');

    } elseif ($type === 'media') {
        $media = Media::findOrFail($id);

        $media->publication()->firstOrCreate([]);
        $media->publication()->increment('views');

    } else {
        abort(404);
    }

    $request->session()->put($sessionKey, true);
}

}
