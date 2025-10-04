<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\IncidentReportNotification;

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

        $notifications = $user
                ->notifications()
                ->where('type', '!=', IncidentReportNotification::class)
                ->orderBy('created_at', 'desc')
                ->paginate(5);

        return view('spj-content.profile-settings.notifications.index', compact('notifications'));
    }
}
