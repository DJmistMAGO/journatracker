<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;

class FilterCategoryController extends Controller
{
	public function viewCategory($category)
	{
		// Articles
		$articles = Article::where('status', 'Published')
			->where('category', $category)
			->orderBy('date_publish', 'desc')
			->get();

		// Media
		$media = Media::where('status', 'Published')
			->where('category', $category)
			->orderBy('date_publish', 'desc')
			->get();

		// Merge articles and media
		$items = $articles->concat($media)->sortByDesc('date_publish')->values();

		return view('spj-content.spj-landingpage.filter-category', compact('category', 'items'));
	}

	public function showContent($type, $id, Request $request)
	{
		$sessionKey = "viewed_{$type}_{$id}";

		if ($type === 'Article') {
			$item = Article::findOrFail($id);
		} elseif ($type === 'Media') {
			$item = Media::findOrFail($id);
		} else {
			abort(404);
		}

		// Increment views only if not already viewed in this session
		if (!$request->session()->has($sessionKey)) {
			$publication = $item->publication()->firstOrCreate([]);
			$publication->increment('views');
			$request->session()->put($sessionKey, true);
		}

		return view('spj-content.spj-landingpage.article-content', compact('item'));
	}
}
