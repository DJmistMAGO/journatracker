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
    // 1️⃣ Validate request
    $data = $request->validate([
      'title_article' => 'required|string|max:255',
      'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
      'article_content' => 'required|string',
      'date_written' => 'required|date',
      'category' => 'required|string|max:100',
      'tags' => 'nullable|string', // tags come as JSON string
    ]);

    // 2️⃣ Decode tags JSON into array
    $data['tags'] = $data['tags'] ? json_decode($data['tags'], true) : [];

    // 3️⃣ Handle thumbnail upload
    if ($request->hasFile('thumbnail_image')) {
      $file = $request->file('thumbnail_image');
      $date = date('Y-m-d');
      $extension = $file->getClientOriginalExtension();

      // Count existing images for today
      $count = Storage::disk('public')->files('thumbnails');
      $todayCount = collect($count)
        ->filter(fn($f) => str_contains(basename($f), "article_{$date}_"))
        ->count();
      $increment = $todayCount + 1;

      $filename = "article_{$date}_{$increment}.{$extension}";

      $data['thumbnail_image'] = $file->storeAs('thumbnails', $filename, 'public');
    }

    // 4️⃣ Assign current user ID
    $data['user_id'] = Auth::id();

    // 5️⃣ Create the article
    Article::create($data);

    // 6️⃣ Redirect with success message
    return redirect()
      ->route('article-management')
      ->with('success', 'Article created successfully!');
  }

  //view
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
}
