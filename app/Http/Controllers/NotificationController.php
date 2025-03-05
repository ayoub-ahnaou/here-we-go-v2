<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications; // Fetch all notifications
        $unreadNotifications = $user->unreadNotifications; // Fetch unread notifications

        return view('notifications.index', [
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }
}
