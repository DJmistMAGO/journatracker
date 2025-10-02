<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;

class FilterCategoryController extends Controller
{
    public function viewCategory($category)
    {
        // Articles
        $articles = Article::where('status', 'Published')
            ->where('category', $category)
            ->orderBy('date_publish', 'desc')
            ->get();

        // Media
        $media = Media::where('status', 'Published')
            ->where('category', $category)
            ->orderBy('date_publish', 'desc')
            ->get();

        // Merge articles and media, sort by date_publish descending
        $items = $articles
            ->concat($media)
            ->sortByDesc('date_publish')
            ->values();

        return view('spj-content.spj-landingpage.filter-category', compact('category', 'items'));
    }

    public function showContent($type, $id, Request $request)
    {
        $cookieKey = "viewed_{$type}_{$id}";

        if ($type === 'Article') {
            $item = Article::findOrFail($id);
        } elseif ($type === 'Media') {
            $item = Media::findOrFail($id);
        } else {
            abort(404);
        }

        // Increment views only if no cookie exists
        if (!$request->cookies->has($cookieKey)) {
            $publication = $item->publication()->firstOrCreate([]);
            $publication->increment('views');

            // Set cookie for 1 year
            cookie()->queue($cookieKey, true, 60 * 24 * 365);
        }

        return view('spj-content.spj-landingpage.article-content', compact('item'));
    }
}
