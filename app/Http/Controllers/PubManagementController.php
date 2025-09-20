<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;

class PubManagementController extends Controller
{
	public function index()
	{
		$articles = Article::with('user')->orderBy("created_at", "desc")->get();
		$media    = Media::with('user')->orderBy("created_at", "desc")->get();

		// Map articles into a common structure
		$articles = $articles->map(function ($article) {
			return [
				'id'     => $article->id,
				'type'   => 'Article',
				'title'  => $article->title_article,
				'author' => $article->user->name ?? 'Unknown',
				'date'   => $article->date_written,
				'status' => $article->status,
			];
		});

		// Map media into a common structure
		$media = $media->map(function ($mediaItem) {
			return [
				'id'     => $mediaItem->id,
				'type'   => 'Media',
				'title'  => $mediaItem->title,
				'author' => $mediaItem->user->name ?? 'Unknown',
				'date'   => $mediaItem->date,
				'status' => $mediaItem->status ?? 'Draft',
			];
		});

		// Merge them into one collection
		$items = $articles->merge($media)->sortByDesc('date');

		return view('spj-content.publication-management.index', compact('items'));
	}



	public function create()
	{
		return view('spj-content.publication-management.create');
	}
}
