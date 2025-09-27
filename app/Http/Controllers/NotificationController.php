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
    $notification = $request->user()->notifications()->findOrFail($id);
    $notification->markAsRead();

    return response()->json(['success' => true]);
}


}
