<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
	public function index(){

		$auth_id = Auth::user()->id;

		//get article and map data
		$articles = Article::with('user')
			->where('user_id',$auth_id)
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

		//get media and map data
		$media = Media::with('user')
			->where('user_id',$auth_id)
			->where('status', 'Draft')
			->orderBy('created_at', 'desc')
			->get()
			->map(function ($mediaItem) {
				return (object) [
					'id' => $mediaItem->id,
					'title' => $mediaItem->title,
					'type' => 'Media',
					'user' => $mediaItem->user,
					'status' => $mediaItem->status,
					'date' => $mediaItem->date ?? $mediaItem->created_at,
					'created_at' => $mediaItem->created_at,
				];
			});

		//merge article and media
		$items = $articles->merge($media)->sortByDesc('date')->values();
		
		return view("spj-content.archive.index", compact('items'));
	}
}
