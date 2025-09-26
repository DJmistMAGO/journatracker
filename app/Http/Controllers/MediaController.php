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
        $photojournalism = Media::where('type', 'Photojournalism')
            ->where('status', 'Draft')
            ->latest()
            ->get();

        $cartooning = Media::where('type', 'Cartooning')
            ->where('status', 'Draft')
            ->latest()
            ->get();

        $tv = Media::where('type', 'TV Broadcasting')
            ->where('status', 'Draft')
            ->latest()
            ->get();

        $radio = Media::where('type', 'Radio Broadcasting')
            ->where('status', 'Draft')
            ->latest()
            ->get();

        // dd($photojournalism, $cartooning, $tv, $radio);

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
        // dd($request->all());
        $rules = [
            'media_type' => 'required|in:Photojournalism,Cartooning,TV Broadcasting,Radio Broadcasting',
            'title' => 'required|string|max:255',
            'date' => 'nullable|date',
            'tags' => 'nullable', // still comes as JSON string
            'description' => 'nullable|string',
        ];

        // If tags is passed as JSON, decode to array
        if ($request->has('tags')) {
            $decoded = json_decode($request->tags, true);
            $request->merge(['tags' => $decoded ?? []]);
        }

        // Conditional rules
        if ($request->isMethod('post') && in_array($request->media_type, ['Photojournalism', 'Cartooning'])) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        if (in_array($request->media_type, ['TV Broadcasting', 'Radio Broadcasting'])) {
            $rules['link'] = 'required|string';
        }

        $data = $request->validate($rules);

        // Normalize date (default today if missing)
        $data['date'] = $data['date'] ?? now()->toDateString();

        // Handle image upload for photojournalism/cartooning
        if ($request->hasFile('image')) {
            $file = $request->file('image');
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

        // Save media
        Media::create([
            'user_id' => Auth::id(),
            'type' => $data['media_type'],
            'title' => $data['title'],
            'date' => $data['date'],
            'tags' => $data['tags'], // stored as array → JSON in DB (because of casts)
            'description' => $data['description'] ?? null,
            'image_path' => $data['image_path'] ?? null,
            'link' => $data['link'] ?? null,
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
    public function update(Request $request, Media $media)
    {
        $rules = [
            'media_type' => 'required|in:Photojournalism,Cartooning,TV Broadcasting,Radio Broadcasting',
            'title' => 'required|string|max:255',
            'date' => 'nullable|date',
            'tags' => 'nullable', // can be string (JSON) or array
            'description' => 'nullable|string',
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
        if (in_array($request->media_type, ['Photojournalism', 'Cartooning'])) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        if (in_array($request->media_type, ['TV Broadcasting', 'Radio Broadcasting'])) {
            $rules['link'] = 'required|string';
        }

        $data = $request->validate($rules);

        // Normalize date (default today if missing)
        $data['date'] = $data['date'] ?? now()->toDateString();

        // Handle image upload if new file uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
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

        // Update media
        $media->update([
            'type' => $data['media_type'],
            'title' => $data['title'],
            'date' => $data['date'],
            'tags' => $data['tags'], // array -> JSON in DB because of casts
            'description' => $data['description'] ?? null,
            'image_path' => $data['image_path'] ?? $media->image_path,
            'link' => $data['link'] ?? null,
        ]);

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
