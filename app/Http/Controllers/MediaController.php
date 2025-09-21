<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MediaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$photojournalism = Media::where('type', 'photojournalism')->latest()->get();
		$cartooning = Media::where('type', 'cartooning')->latest()->get();
		$tv = Media::where('type', 'tv_broadcasting')->latest()->get();
		$radio = Media::where('type', 'radio_broadcasting')->latest()->get();

		return view('spj-content.media-management.index', compact('photojournalism', 'cartooning', 'tv', 'radio'));
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
			'media_type'  => 'required|in:photojournalism,cartooning,tv_broadcasting,radio_broadcasting',
			'title'       => 'required|string|max:255',
			'date'        => 'required|date',
			'tags'        => 'nullable|string',
			'description' => 'nullable|string',
		];

		// Conditional rules
		if (in_array($request->media_type, ['photojournalism', 'cartooning'])) {
			$rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
		}

		if (in_array($request->media_type, ['tv_broadcasting', 'radio_broadcasting'])) {
			$rules['link'] = 'required|url';
		}

		$data = $request->validate($rules);

		// dd($data);

		$data['date'] = $data['date'] ?? now()->toDateString();

		//tags handling
		$data['tags'] = $data['tags'] ? json_decode($data['tags'], true) : [];

		// Handle image if photojournalism/cartooning
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$date = now()->format('Y-m-d'); // safer than date('Y-m-d')
			$extension = $file->getClientOriginalExtension();

			// Count files for today in /storage/app/public/media
			$count = Storage::disk('public')->files('media');
			$todayCount = collect($count)
				->filter(fn($f) => str_contains(basename($f), "media{$date}_"))
				->count();

			$increment = $todayCount + 1;
			$filename = "media{$date}_{$increment}.{$extension}";

			// Store with custom filename
			$data['image_path'] = $file->storeAs('media', $filename, 'public');
		}

		  // Save to database
    Media::create([
        'user_id'     => Auth::id(),
        'type'        => $data['media_type'],
        'title'       => $data['title'],
        'date'        => $data['date'],
        'tags'        => $data['tags'],
        'description' => $data['description'] ?? null,
        'image_path'  => $data['image_path'] ?? null,
        'link'        => $data['link'] ?? null,
    ]);

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
		// You can eager load relationships here if you later relate user or tags
		return view('spj-content.media-management.show', compact('media'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit( $id)
	{
		$media = Media::with('user')->findOrFail($id);
		return view('spj-content.media-management.edit', compact('media'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, $id)
    {
        $item = Media::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'media_type'   => 'required|string',
            'title'        => 'required|string|max:255',
            'date'         => 'required|date',
            'description'  => 'nullable|string',
            'tags'         => 'nullable|string', // JSON string
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'link'         => 'nullable|url',
        ]);

		//tags json handling
		$validated['tags'] = $validated['tags'] ? json_decode($validated['tags'], true) : [];

        // Handle file upload (if new image uploaded)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/media', 'public');
            $validated['thumbnail_image'] = $path;
        }



        // Update the record
        $item->update($validated);

		return redirect()
			->route('media-management')
			->with('success', 'Media updated successfully!');
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
