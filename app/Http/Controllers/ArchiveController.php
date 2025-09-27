<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;
use App\Models\PubManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		$auth_id = $user->id;

		// Get first role of the user
		$user_role = $user->getRoleNames()->first();

		if ($user_role === "admin" || $user_role === "eic") {

			$articles = Article::with('user')
				->where('status', 'Published')
				->orderBy('date_publish', 'desc')
				->get();

			$media = Media::with('user')
				->where('status', 'Published')
				->orderBy('date_publish', 'desc')
				->get();
		} else {
			$articles = Article::with('user')
				->where('user_id', $auth_id)
				->where('status', 'Published')
				->orderBy('date_publish', 'desc')
				->get();

			$media = Media::with('user')
				->where('user_id', $auth_id)
				->where('status', 'Published')
				->orderBy('date_publish', 'desc')
				->get();
		}

		// Merge articles and media
		$items = $articles->concat($media)->sortByDesc('date')->values();


		return view("spj-content.archive.index", compact('items'));
	}

	

}
