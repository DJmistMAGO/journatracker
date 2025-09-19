<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleManagementController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('spj-content.article-management.index', compact('articles'));
    }

    public function create()
    {
        return view('spj-content.article-management.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'title_article' => 'required|string|max:255',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'article_content' => 'required|string',
            'date_written' => 'required|date',
            'category' => 'required|string|max:100',
            'tags' => 'nullable|string', // tags come as JSON string
        ]);

        $data['date_written'] = $data['date_written'] ?? now()->toDateString();

        // dd($data);

        $data['tags'] = $data['tags'] ? json_decode($data['tags'], true) : [];

        if ($request->hasFile('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $date = date('Y-m-d');
            $extension = $file->getClientOriginalExtension();

            $count = Storage::disk('public')->files('thumbnails');
            $todayCount = collect($count)
                ->filter(fn($f) => str_contains(basename($f), "article_{$date}_"))
                ->count();
            $increment = $todayCount + 1;

            $filename = "article_{$date}_{$increment}.{$extension}";

            $data['thumbnail_image'] = $file->storeAs('thumbnails', $filename, 'public');
        }

        $data['user_id'] = Auth::id();

        Article::create($data);

        return redirect()
            ->route('article-management')
            ->with('success', 'Article created successfully!');
    }

    public function show($id)
    {
        $article = Article::with('user')->findOrFail($id);
        // dd($article);
        return view('spj-content.article-management.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::with('user')->findOrFail($id);
        return view('spj-content.article-management.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $data = $request->validate([
            'title_article' => 'required|string|max:255',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'article_content' => 'required|string',
            'date_written' => 'required|date',
            'category' => 'required|string|max:100',
            'tags' => 'nullable|string', // tags come as JSON string
        ]);

        $data['tags'] = $data['tags'] ? json_decode($data['tags'], true) : [];

        if ($request->hasFile('thumbnail_image')) {
            // Delete old thumbnail if exists
            if ($article->thumbnail_image && Storage::disk('public')->exists($article->thumbnail_image)) {
                Storage::disk('public')->delete($article->thumbnail_image);
            }

            $file = $request->file('thumbnail_image');
            $date = date('Y-m-d');
            $extension = $file->getClientOriginalExtension();

            $count = Storage::disk('public')->files('thumbnails');
            $todayCount = collect($count)
                ->filter(fn($f) => str_contains(basename($f), "article_{$date}_"))
                ->count();
            $increment = $todayCount + 1;

            $filename = "article_{$date}_{$increment}.{$extension}";

            $data['thumbnail_image'] = $file->storeAs('thumbnails', $filename, 'public');
        }

        $article->update($data);

        return redirect()
            ->route('article-management')
            ->with('success', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Delete thumbnail if exists
        if ($article->thumbnail_image && Storage::disk('public')->exists($article->thumbnail_image)) {
            Storage::disk('public')->delete($article->thumbnail_image);
        }

        $article->delete();

        return redirect()
            ->route('article-management')
            ->with('success', 'Article deleted successfully!');
    }
}
