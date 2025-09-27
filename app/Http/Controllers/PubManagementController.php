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
		// Map articles
		$articles = Article::with('user')
			->where('status', 'Draft')
			->orderBy('date_submitted', 'desc')
			->get()
			->map(function ($item) {
				$item->type;
				return $item;
			});


		// Map media
		$media = Media::with('user')
			->where('status', 'Draft')
			->orderBy('date_submitted', 'desc')
			->get()
			->map(function ($item) {
				$item->type;
				return $item;
			});

		// Merge & sort
		$items = $articles->concat($media)->sortByDesc('date_submitted')->values();

		return view('spj-content.publication-management.index', compact('items'));
	}



	public function show($type, $id)
	{
		$type = strtolower(trim($type));

		if ($type === 'article') {
			$item = Article::findOrFail($id);
		} elseif ($type === 'media') {
			$item = Media::findOrFail($id);
		} else {
			abort(404, 'Invalid type.');
		}

		return view('spj-content.publication-management.show', ['item' => $item, 'type' => $type,]);
	}

	public function updateStatus($type, $id, Request $request)
	{

		// Find the correct item
		if ($type === 'Article') {
			$item = Article::with('user')->findOrFail($id);

		} elseif ($type === 'Media') {
			$item = Media::with('user')->findOrFail($id);

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



		// // Send email to author
		// if ($item->user && $item->user->email) {
		// 	Mail::to($item->user->email)->queue(new StatusUpdateNotification(
		// 		$item->user->first_name,           // or $item->user->name if you defined accessor
		// 		$itemMapped['type'],               // Article or Media
		// 		$itemMapped['title'] ?? 'Untitled',
		// 		$validated['status'],
		// 		$validated['remarks'] ?? null,
		// 		$validated['date_publish'] ?? null
		// 	));
		// }

		return redirect()->route('publication-management.index')->with('success', ucfirst($type) . ' status updated successfully.');
	}
}
