<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;

class PubManagementController extends Controller
{
	public function index()
{
    // Articles
    $articles = Article::with('user')
        ->where('status', 'Draft')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($article) {
            return (object) [
                'id' => $article->id,
                'title' => $article->title_article,
                'type' => 'Article',
                'user' => $article->user,
                'status' => $article->status,
                'date' => $article->date_written ?? $article->created_at,
                'created_at' => $article->created_at,
            ];
        });

    // Media
    $media = Media::with('user')
        ->where('status', 'Draft')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($mediaItem) {
            return (object) [
                'id' => $mediaItem->id,
                'title' => $mediaItem->title, // assuming media has `title` field
                'type' => 'Media',
                'user' => $mediaItem->user,
                'status' => $mediaItem->status,
                'date' => $mediaItem->date ?? $mediaItem->created_at,
                'created_at' => $mediaItem->created_at,
            ];
        });

    // Merge and sort by date
    $items = $articles->merge($media)->sortByDesc('date')->values();

    return view('spj-content.publication-management.index', compact('items'));
}



	public function show($type, $id)
	{
		$type = strtolower(trim($type));

		if ($type === 'article') {
			$item = Article::findOrFail($id);

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
			$item = Media::findOrFail($id);

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

	public function updateStatus($type, $id, Request $request)
{
    // Find the correct item
    if ($type === 'article') {
        $item = Article::findOrFail($id);
    } elseif ($type === 'media') {
        $item = Media::findOrFail($id);
    }

    // Validate request
    $validated = $request->validate([
        'status' => 'required|in:Published,Revision,Rejected', // Draft is default, so not included
        'date_publish' => 'required_if:status,Published|nullable|date',
        'remarks' => 'required_if:status,Revision,Rejected|nullable|string|max:1000',
    ]);

    // Save values
    $item->status = $validated['status'];
    $item->date_publish = $validated['date_publish'] ?? null;
    $item->remarks = $validated['remarks'] ?? null;

    $item->save();

    return redirect()->back()->with('success', ucfirst($type) . ' status updated successfully.');
}


}
