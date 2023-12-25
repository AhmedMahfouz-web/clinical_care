<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function get_notification()
    {
        if (auth()->user() != null) {
            $notifications = Notification::where('reciever_id', auth()->user()->id)->where('read_at', null)->latest()->get();
        } else {
            $notifications = Notification::where('reciever_id', auth()->guard('admin')->user()->id)->where('read_at', null)->latest()->get();
        }

        return response()->json([
            'status' => 'success',
            'notifications' => $notifications
        ]);
    }

    public function read_notification(Notification $notification)
    {
        if ($notification->reciever_id == auth()->user()->id) {
            $notification->update([
                'read_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
            ]);
        }

        return response()->json([
            'status' => 'failed',
        ]);
    }
}
