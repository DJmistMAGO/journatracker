<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\Media;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class Analytics extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $articlesCount = $articles->count();
        $articlesPublishedCount = $articles->where('status', 'Published')->count();
        $articlesDraftCount = $articles->where('status', 'Draft')->count();
        $articlesArchivedCount = $articles->where('status', 'Archived')->count();

        $media = Media::all();
        $mediaCount = $media->count();
        $mediaPublishedCount = $media->where('status', 'Published')->count();
        $mediaDraftCount = $media->where('status', 'Draft')->count();
        $mediaArchivedCount = $media->where('status', 'Archived')->count();

        $users = User::all();
        $usersCount = $users->count();
        $adminsCount = 0;
        $editorsCount = 0;
        $writersCount = 0;
        foreach ($users as $user) {
            if ($user->isRole('admin')) {
                $adminsCount++;
            } elseif ($user->isRole('eic')) {
                $editorsCount++;
            } elseif ($user->isRole('student')) {
                $writersCount++;
            }
        }

        $activeUsersCount = User::where('status', 'active')->count();

        // notifications
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        $notificationsCount = $notifications->count();

        return view(
            'spj-content.dashboard.dashboards-analytics',
            compact(
                'articlesCount',
                'articlesPublishedCount',
                'articlesDraftCount',
                'articlesArchivedCount',
                'usersCount',
                'adminsCount',
                'editorsCount',
                'writersCount',
                'activeUsersCount',
                'mediaCount',
                'mediaPublishedCount',
                'mediaDraftCount',
                'mediaArchivedCount',
                'notifications'
            )
        );
    }
}
