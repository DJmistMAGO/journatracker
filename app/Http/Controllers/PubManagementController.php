<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;
use App\Mail\StatusUpdateNotification;
use Illuminate\Support\Facades\Mail;

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
			$item = Article::with('user')->findOrFail($id);

			// Map article into common structure
			$itemMapped = [
				'id'          => $item->id,
				'type'        => 'Article',
				'title'       => $item->title_article,
				'status'      => $item->status,
			];
		} elseif ($type === 'media') {
			$item = Media::with('user')->findOrFail($id);

			// Map to common structure
			$itemMapped = [
				'id'          => $item->id,
				'type'        => 'Media',
				'title'       => $item->title,
				'status'      => $item->status,
			];
		} else {
			abort(404, 'Invalid type');
		}


		// Validate request
		$validated = $request->validate([
			'status' => 'required|in:Published,Revision,Rejected', // Draft is default
			'date_publish' => 'required_if:status,Published|nullable|date',
			'remarks' => 'required_if:status,Revision,Rejected|nullable|string|max:1000',
		]);

		// Save updated values for status, date_publish, and remarks
		$item->status = $validated['status'];
		$item->date_publish = $validated['date_publish'] ?? null;
		$item->remarks = $validated['remarks'] ?? null;
		$item->save();

		// Send email to author
		if ($item->user && $item->user->email) {
			Mail::to('jkenneth.gerero@gmail.com')->queue(new StatusUpdateNotification(
				$item->user->first_name,           // or $item->user->name if you defined accessor
				$itemMapped['type'],               // Article or Media
				$itemMapped['title'] ?? 'Untitled',
				$validated['status'],
				$validated['remarks'] ?? null,
				$validated['date_publish'] ?? null
			));
		}

		return redirect()->back()->with('success', ucfirst($type) . ' status updated successfully.');
	}
}
