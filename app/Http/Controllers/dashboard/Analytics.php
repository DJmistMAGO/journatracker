<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\Media;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use App\Notifications\IncidentReportNotification;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class Analytics extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isRole('admin')) {
            // Admin: get all notifications (no duplicates)
            $notifications = DatabaseNotification::query()
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        } else {
            // Non-admin: only their own notifications, excluding IncidentReportNotification
            $notifications = $user
                ->notifications()
                ->where('type', '!=', IncidentReportNotification::class)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }

        if ($user->isRole('admin')) {
            // Admin sees everything
            $articles = Article::all();
            $media = Media::all();
            $users = User::all();

            $articlesCount = $articles->count();
            $articlesPublishedCount = $articles->where('status', 'Published')->count();
            $articlesDraftCount = $articles->where('status', 'Draft')->count();
            $articlesArchivedCount = $articles->where('status', 'Archived')->count();

            $mediaCount = $media->count();
            $mediaPublishedCount = $media->where('status', 'Published')->count();
            $mediaDraftCount = $media->where('status', 'Draft')->count();
            $mediaArchivedCount = $media->where('status', 'Archived')->count();

            $usersCount = $users->count();
            $adminsCount = $users->where('role', 'admin')->count();
            $editorsCount = $users->where('role', 'eic')->count();
            $writersCount = $users->where('role', 'student')->count();

            $draftCount = $articles->where('status', 'Draft')->count() + $media->where('status', 'Draft')->count();

            $activeUsersCount = $users->where('status', 'active')->count();
        } elseif ($user->isRole('student')) {
            // Student sees only their own content
            $articles = Article::where('user_id', $user->id)->get();
            $media = Media::where('user_id', $user->id)->get();

            $articlesCount = $articles->count();
            $articlesPublishedCount = $articles->where('status', 'Published')->count();
            $articlesDraftCount = $articles->where('status', 'Draft')->count();
            $articlesArchivedCount = $articles->where('status', 'Archived')->count();

            $mediaCount = $media->count();
            $mediaPublishedCount = $media->where('status', 'Published')->count();
            $mediaDraftCount = $media->where('status', 'Draft')->count();
            $mediaArchivedCount = $media->where('status', 'Archived')->count();
            $draftCount = $articles->where('status', 'Draft')->count() + $media->where('status', 'Draft')->count();

            // Students don't see other users' analytics
            $usersCount = $adminsCount = $editorsCount = $writersCount = $activeUsersCount = null;
        }

        return view(
            'spj-content.dashboard.dashboards-analytics',
            compact(
                'articlesCount',
                'articlesPublishedCount',
                'articlesDraftCount',
                'articlesArchivedCount',
                'mediaCount',
                'mediaPublishedCount',
                'mediaDraftCount',
                'mediaArchivedCount',
                'usersCount',
                'adminsCount',
                'editorsCount',
                'writersCount',
                'activeUsersCount',
                'notifications',
                'draftCount'
            )
        );
    }
}
