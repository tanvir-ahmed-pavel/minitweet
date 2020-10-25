<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function readAll()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }


    public function readSingle($id)
    {
        $notification = Auth::user()->notifications->find($id);
        $notification->markAsRead();

        return redirect(url($notification->data['link']));
    }

}
