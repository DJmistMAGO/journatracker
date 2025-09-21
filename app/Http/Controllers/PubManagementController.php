<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;

class PubManagementController extends Controller
{
	public function index()
{
    // Get all Draft articles with user relation
    $articles = Article::with('user')
        ->where('status', 'Draft')
        ->orderBy('created_at', 'desc')
        ->get()
        ->each(function ($article) {
            $article->type = 'Article'; // Add type property for Blade
        });

    // Get all Draft media with user relation
    $media = Media::with('user')
        ->where('status', 'Draft')
        ->orderBy('created_at', 'desc')
        ->get()
        ->each(function ($mediaItem) {
            $mediaItem->type = 'Media'; // Add type property for Blade
        });

    // Merge articles and media, then sort by date (descending)
    $items = $articles->merge($media)->sortByDesc(function ($item) {
        return $item->created_at ?? now();
    });

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
