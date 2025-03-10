<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class FireBaseController extends Controller
{
    public function sendAll(Request $request)
    {
        $recipients = User::whereNotNull('device_token')->pluck('device_token')->toArray();
        //dd($recipients);

        fcm()
            ->to($recipients) // $recipients must an array
            ->priority('high')
            ->timeToLive(0)
            ->notification([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ])
            ->send();
        $notification = 'Notificacion enviada a todos los usuarios (Android)';
        return back()->with(compact('notification'));
    }
}
