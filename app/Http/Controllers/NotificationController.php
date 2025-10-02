<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markRead(Request $request)
    {
        $user = $request->user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markSingleRead(Request $request, $id)
    {
        $notification = $request
            ->user()
            ->notifications()
            ->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    // show all notifications
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            // Show all notifications for all users
            $notifications = \Illuminate\Notifications\DatabaseNotification::paginate(10);
        } else {
            // Show only the user's notifications
            $notifications = $user->notifications()->paginate(10);
        }

        return view('spj-content.profile-settings.notifications.index', compact('notifications'));
    }
}
