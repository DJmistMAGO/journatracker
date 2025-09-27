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
				->where('type', $category)
				->orderBy('date_publish', 'desc')
				->get();

		// Merge articles and media
		$items = $articles->concat($media)->sortByDesc('date_publish')->values();

		return view('spj-content.spj-landingpage.filter-category', compact('category', 'items'));
	}
}
