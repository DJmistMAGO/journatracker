<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;

class FilterCategoryController extends Controller
{
	public function viewCategory($category)
	{

		// Helper function to map items
		$mapItems = function ($items, $type, $category) {
			return $items->map(function ($item) use ($type, $category) {
				return (object) [
					'id'         => $item->id,
					'title'      => $type === 'Article' ? $item->title_article : $item->title,
					'type'       => $type,        // keep just 'Article' or 'Media'
					'category'   => $category,    // keep category separate
					'user'       => $item->user,
					'status'     => $item->status,
					'date'       => $item->date_publish,
					'created_at' => $item->created_at,
				];
			});
		};

		// Articles
		$articles = $mapItems(
			Article::where('status', 'Published')
				->where('category', $category)
				->orderBy('created_at', 'desc')
				->get(),
			'Article',
			$category
		);

		// Media
		$media = $mapItems(
			Media::where('status', 'Published')
				->where('type', $category)
				->orderBy('created_at', 'desc')
				->get(),
			'Media',
			$category
		);

		// Merge articles and media
		$items = $articles->merge($media)->sortByDesc('date')->values();




		return view('spj-content.spj-landingpage.filter-category', compact('category'));
	}
}
