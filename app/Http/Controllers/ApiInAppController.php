<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiInAppController extends Controller
{
    public function getUnreadNotifications()
    {
        $notifications = auth()->user()->inAppNotifications()->whereNull('received_at')->get();
        foreach ($notifications as $notification) {
            $notification->markAsReceived();
        }
        return response([
            'notifications' => $notifications,
        ], 200);
    }

    public function updateUnreadNotification()
    {
        $notifId = request()->notification_id;

        auth()->user()->inAppNotifications()->find($notifId)->markAsReceived();

        return response([
            'result' => 'success',
        ], 200);
    }
}
