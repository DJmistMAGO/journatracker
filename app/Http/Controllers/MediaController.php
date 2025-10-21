<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\StatusChangedNotification;
use App\Models\User;

class MediaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$user_id = Auth::user()->id;

		// Get search and status from request
		$search = $request->input('search');
		$status = $request->input('status');

		// Filtered $all query
		$all = Media::where('user_id', $user_id)
			->whereIn('status', ['Draft', 'Revision'])
			->when($search, function ($query, $search) {
				$query->where('title', 'like', "%{$search}%");
			})
			->when($status, function ($query, $status) {
				$query->where('status', $status);
			})
			->latest()
			->get();

		// Other category queries remain the same
		$photojournalism = Media::where("user_id", $user_id)
			->where('category', 'Photojournalism')
			->whereIn('status', ['Draft', 'Revision'])
			->latest()
			->get();

		$cartooning = Media::where('user_id', $user_id)
			->where('category', 'Cartooning')
			->whereIn('status', ['Draft', 'Revision'])
			->latest()
			->get();

		$tv = Media::where('user_id', $user_id)
			->where('category', 'TV Broadcasting')
			->whereIn('status', ['Draft', 'Revision'])
			->latest()
			->get();

		$radio = Media::where('user_id', $user_id)
			->where('category', 'Radio Broadcasting')
			->whereIn('status', ['Draft', 'Revision'])
			->latest()
			->get();

		return view('spj-content.media-management.index', compact('all', 'photojournalism', 'cartooning', 'tv', 'radio'));
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('spj-content.media-management.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */

	public function store(Request $request)
	{
		$rules = [
			'category' => 'required|in:Photojournalism,Cartooning,TV Broadcasting,Radio Broadcasting',
			'title' => 'required|string|max:255',
			'date_submitted' => 'required|date',
			'tags' => 'nullable', // still comes as JSON string
			'description' => 'required|string',
		];

		// If tags is passed as JSON, decode to array
		if ($request->has('tags')) {
			$decoded = json_decode($request->tags, true);
			$request->merge(['tags' => $decoded ?? []]);
		}

		// Conditional rules
		if ($request->isMethod('post') && in_array($request->category, ['Photojournalism', 'Cartooning'])) {
			$rules['image_path'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
		}

		if (in_array($request->category, ['TV Broadcasting', 'Radio Broadcasting'])) {
			$rules['link'] = 'required|string';
		}

		$data = $request->validate($rules);

		// Handle image upload for photojournalism/cartooning
		if ($request->hasFile('image_path')) {
			$file = $request->file('image_path');
			$datePrefix = now()->format('Y-m-d');
			$extension = $file->getClientOriginalExtension();

			// Count how many files were uploaded today
			$todayCount = collect(Storage::disk('public')->files('media'))
				->filter(fn($f) => str_contains(basename($f), "media_{$datePrefix}_"))
				->count();

			// Create a unique filename
			$filename = "media_{$datePrefix}_" . ($todayCount + 1) . ".{$extension}";

			// Store in public/media/
			$data['image_path'] = $file->storeAs('media', $filename, 'public');
		}


		// Clean Facebook/YouTube embed codes -> extract src if present
		if (!empty($data['link']) && preg_match('/src="([^"]+)"/', $data['link'], $matches)) {
			$data['link'] = $matches[1];
		}

		$media = Media::create([
			'user_id' => Auth::id(),
			'category' => $data['category'],
			'title' => $data['title'],
			'date_submitted' => $data['date_submitted'],
			'tags' => $data['tags'], // stored as array → JSON in DB (because of casts)
			'description' => $data['description'] ?? null,
			'image_path' => $data['image_path'] ?? null,
			'link' => $data['link'] ?? null,
		]);

		$media->type   = $media->type ?? 'Media';
		$media->status = $media->status ?? 'Draft';

		$media->author->notify(new StatusChangedNotification($media));

		// Get all users with role 'Admin' or 'EIC'
		$usersToNotify = User::role(['admin', 'eic'])->get();
		foreach ($usersToNotify as $user) {
			$user->notify(new StatusChangedNotification($media));
		}


		return redirect()
			->route('media-management')
			->with('success', 'Media created successfully!');
	}

	/**
	 * Display the specified resource.
	 */
	public function show($id)
	{
		$media = Media::with('user')->findOrFail($id);

		// dd($media);
		return view('spj-content.media-management.show', compact('media'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit($id)
	{
		$media = Media::with('user')->findOrFail($id);



		return view('spj-content.media-management.edit', compact('media'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, $id)
	{
		$media = Media::findOrFail($id);

		$rules = [
			'category'       => 'required|in:Photojournalism,Cartooning,TV Broadcasting,Radio Broadcasting',
			'title'          => 'required|string|max:255',
			'date_submitted' => 'required|date',
			'tags'           => 'nullable', // string (JSON) or array
			'description'    => 'required|string',
		];

		// Handle tags: decode JSON if string
		if ($request->has('tags')) {
			$tags = $request->tags;

			if (is_string($tags)) {
				$tags = json_decode($tags, true) ?? [];
			}

			$request->merge(['tags' => $tags]);
		}

		// Conditional rules
		if (in_array($request->category, ['Photojournalism', 'Cartooning'])) {
			$rules['image_path'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
		}

		if (in_array($request->category, ['TV Broadcasting', 'Radio Broadcasting'])) {
			$rules['link'] = 'required|string';
		}

		$data = $request->validate($rules);

		// Handle image upload if new file uploaded
		if ($request->hasFile('image_path')) {
			$file = $request->file('image_path');
			$datePrefix = now()->format('Y-m-d');
			$extension = $file->getClientOriginalExtension();

			$todayCount = collect(Storage::disk('public')->files('media'))
				->filter(fn($f) => str_contains(basename($f), "media{$datePrefix}_"))
				->count();

			$filename = "media{$datePrefix}_" . ($todayCount + 1) . ".{$extension}";
			$data['image_path'] = $file->storeAs('media', $filename, 'public');
		}

		// Clean Facebook/YouTube embed codes -> extract src if present
		if (!empty($data['link']) && preg_match('/src="([^"]+)"/', $data['link'], $matches)) {
			$data['link'] = $matches[1];
		}

		// Prepare update payload
		$updateData = [
			'category'       => $data['category'],
			'title'          => $data['title'],
			'date_submitted' => $data['date_submitted'],
			'tags'           => $data['tags'],
			'description'    => $data['description'] ?? null,
			'image_path'     => $data['image_path'] ?? $media->image_path,
			'status'         => 'Draft',
		];

		if (isset($data['link'])) {
			$updateData['link'] = $data['link'];
		}

		$user = Auth::user();
		$user_role = $user->getRoleNames()->first();

		if ($user_role == "eic") {
			$updateData['status'] = 'For Publish';
		}

		$media->update($updateData);


		if ($user_role == "eic") {
			return redirect()
				->route('publication-management.index')
				->with('success', 'Media updated successfully!');
		} else {
			return redirect()
				->route('media-management')
				->with('success', 'Media updated successfully!');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id)
	{
		$media = Media::findOrFail($id);

		// Delete image if exists
		if ($media->image_path && Storage::disk('public')->exists($media->image_path)) {
			Storage::disk('public')->delete($media->image_path);
		}

		$media->delete();

		return redirect()
			->route('media-management')
			->with('success', 'Media deleted successfully!');
	}
}
