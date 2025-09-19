<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		return view('spj-content.media-management.index');
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
    // validate based on type
    $rules = [
        'media_type' => 'required|in:photojournalism,cartooning,tv_broadcasting,radio_broadcasting',
        'title' => 'required|string|max:255',
        'date' => 'required|date',
        'tags' => 'nullable|string',
        'description' => 'nullable|string',
    ];

    if ($request->type === 'photojournalism' || $request->type === 'cartooning') {
        $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
    }

    if ($request->type === 'tv_broadcasting') {
        $rules['link'] = 'required|url';
    }

    $validated = $request->validate($rules);

    // prepare data
    $data = [
        'user_id'     => Auth::id(),
        'type'        => $validated['media_type'],
        'title'       => $validated['title'],
        'date'        => $validated['date'],
        'tags'        => $validated['tags'] ?? null,
        'description' => $validated['description'] ?? null,
    ];

    // handle image if photojournalism/cartooning
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('uploads/media', 'public');
        $data['image_path'] = $path;
    }

    // handle link if tv broadcasting
    if ($request->type === 'tv_broadcasting') {
        $data['link'] = $validated['link'];
    }

    // save to database
    Media::create($data);

    return redirect()
            ->route('media-management')
            ->with('success', 'Media created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        //
    }
}
