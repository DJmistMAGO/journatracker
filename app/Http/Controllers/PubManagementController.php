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

public function show($type, $id)
{
    $type = strtolower(trim($type));

    if ($type === 'article') {
        $item = Article::with('user')->findOrFail($id);

        // Map article into common structure
        $itemMapped = [
            'id'          => $item->id,
            'type'        => 'Article',
            'title'       => $item->title_article,
            'author'      => $item->user->name ?? 'Unknown',
            'date'        => $item->date_written,
            'status'      => $item->status,
            'thumbnail'   => $item->thumbnail_image,
            'content'     => $item->article_content,
            'category'    => $item->category,
            'tags'        => $item->tags ?? [],
        ];

    } elseif ($type === 'media') {
        $item = Media::with('user')->findOrFail($id);

        // Map media into common structure
        $itemMapped = [
            'id'          => $item->id,
            'type'        => 'Media',
            'title'       => $item->title,
            'author'      => $item->user->name ?? 'Unknown',
            'date'        => $item->date,
            'status'      => $item->status ?? 'Draft',
            'media_type'  => $item->type,
            'description' => $item->description,
            'image_path'  => $item->image_path,
            'link'        => $item->link,
            'tags'        => $item->tags ?? [],
        ];

    } else {
        abort(404, 'Invalid type.');
    }

    return view('spj-content.publication-management.show', [
        'item' => $itemMapped,
        'type' => $type,
    ]);
}

	public function create()
	{
		return view('spj-content.publication-management.create');
	}
}
