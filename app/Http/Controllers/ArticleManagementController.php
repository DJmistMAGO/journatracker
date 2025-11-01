<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\StatusChangedNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusUpdateNotification;
use App\Models\User;

class ArticleManagementController extends Controller
{
	public function index(Request $request)
	{
		$authUser = Auth::user();
		$search = $request->input('search');
		$status = $request->input('status');

		if ($authUser->hasRole('admin')) {
			// Admin can view all articles, optionally filtered
			$articles = Article::with('user')
				->whereIn('status', ['Submitted', 'Revision'])
				->when($search, fn($query) => $query->where('title', 'like', "%{$search}%"))
				->when($status, fn($query) => $query->where('status', $status))
				->orderBy('created_at', 'desc')
				->get();
		} else {
			// Non-admin users only see their own Submitted/Revision articles
			$articles = Article::with('user')
				->where('user_id', $authUser->id)
				->whereIn('status', ['Submitted', 'Revision'])
				->when($search, fn($query) => $query->where('title', 'like', "%{$search}%"))
				->when($status, fn($query) => $query->where('status', $status))
				->orderBy('created_at', 'desc')
				->get();
		}

		return view('spj-content.article-management.index', compact('articles'));
	}


	public function create()
	{
		return view('spj-content.article-management.create');
	}

	public function store(Request $request)
	{
		// Validate input fields
		$data = $request->validate([
			'title' => 'required|string|max:255',
			'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
			'description' => 'required|string',
			'date_submitted' => 'required|date',
			'category' => 'required|string|max:100',
			'tags' => 'nullable|string', // tags come as JSON string
		]);

		// Convert tags into array (if provided)
		$data['tags'] = $data['tags'] ? json_decode($data['tags'], true) : [];

		// Handle image upload
		if ($request->hasFile('image_path')) {
			$file = $request->file('image_path');
			$date = date('Y-m-d');
			$extension = $file->getClientOriginalExtension();

			$count = Storage::disk('public')->files('articles');
			$todayCount = collect($count)
				->filter(fn($f) => str_contains(basename($f), "article_{$date}_"))
				->count();
			$increment = $todayCount + 1;

			$filename = "article_{$date}_{$increment}.{$extension}";

			$data['image_path'] = $file->storeAs('articles', $filename, 'public');
		}

		// Attach logged-in user
		$data['user_id'] = Auth::id();

		// Default type
		$data['type'] = 'Article';

		// Save article and get the model instance
		$article = Article::create($data);

		$article->type = $article->type ?? 'Article';
		$article->status = $article->status ?? 'Submitted';

		$article->author->notify(new StatusChangedNotification($article));

		// Get all users with role 'Admin' or 'EIC'
		$usersToNotify = User::role(['admin', 'eic'])->get();
		foreach ($usersToNotify as $user) {
			$user->notify(new StatusChangedNotification($article));
		}

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
			'title' => 'required|string|max:255',
			'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
			'description' => 'required|string',
			'date_submitted' => 'required|date',
			'category' => 'required|string|max:100',
			'tags' => 'nullable|string', // tags come as JSON string
		]);

		$data['tags'] = $data['tags'] ? json_decode($data['tags'], true) : [];

		// Handle image upload
		if ($request->hasFile('image_path')) {
			// Delete old image if exists
			if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
				Storage::disk('public')->delete($article->image_path);
			}

			$file = $request->file('image_path');
			$date = date('Y-m-d');
			$extension = $file->getClientOriginalExtension();

			$count = Storage::disk('public')->files('articles');
			$todayCount = collect($count)
				->filter(fn($f) => str_contains(basename($f), "article_{$date}_"))
				->count();
			$increment = $todayCount + 1;

			$filename = "article_{$date}_{$increment}.{$extension}";

			$data['image_path'] = $file->storeAs('articles', $filename, 'public');
		}

		$user = Auth::user();
		$user_role = $user->getRoleNames()->first();

		if ($user_role == "eic") {
			$data['status'] = 'For Publish';
		}

		$article->update($data);

		if ($user_role == "eic") {
			//email notification to author
			Mail::to($article->user->email)->queue(
				new StatusUpdateNotification(
					$article->user->penname ?? $article->user->name,
					$article->type,
					$article->title ?? 'Untitled',
					$article->status,
					$article->remarks,
					$article->date_publish,
					$article->publish_at
				)
			);

			return redirect()
				->route('publication-management.index')
				->with('success', 'Article updated successfully!');
		} else {
			return redirect()
				->route('article-management')
				->with('success', 'Article updated successfully!');
		}
	}

	public function destroy($id)
	{
		$article = Article::findOrFail($id);

		// Delete image if exists
		if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
			Storage::disk('public')->delete($article->image_path);
		}

		$article->delete();

		return redirect()
			->route('article-management')
			->with('success', 'Article deleted successfully!');
	}

	public function approve($id)
	{
		$article = Article::findOrFail($id);
		$article->status = 'Approved';
		$article->save();

		return back()->with('success', 'Article approved successfully.');
	}

	public function disapprove($id)
	{
		$article = Article::findOrFail($id);
		$article->status = 'Revision';
		$article->save();

		return back()->with('warning', 'Article sent back for revision.');
	}

	public function archive($id)
	{
		$article = Article::findOrFail($id);
		$article->status = 'Archived';
		$article->save();

		return back()->with('info', 'Article archived successfully.');
	}
}
