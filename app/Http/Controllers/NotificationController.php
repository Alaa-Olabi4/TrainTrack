<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use PHPUnit\Framework\TestStatus\Notice;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Notification::all();
    }

    public function myNotifications()
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $notifications = Notification::where('user_id', $user->id)->get();
        return $notifications;
    }

    public function setRead($notification_id)
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $notification = Notification::findOrFail($notification_id);

        if ($notification->user_id == $user->id) {
            $notification->status == 'unread'
                ? $notification->update(['status' => 'read'])
                : $notification->update(['status' => 'unread']);

            return response()->json(['message' => 'Notification status updated successfully !']);
        }
        return response()->json(['message' => 'Sorry , you can\'t update this notification status !']);
    }
}
