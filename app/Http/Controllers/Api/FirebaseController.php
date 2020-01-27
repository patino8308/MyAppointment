<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FirebaseController extends Controller
{

    public function postToken(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($request->has('device_token')) {
            $user->device_token = $request->input('device_token');
            $user->save();
        }
    }
}
http://3.133.87.66/api/fcm/token?device_token=dfiUM9bM0Rw%3AAPA91bHqu7tCaKG3M3XRFtCBRbrsQhOPiL-UJMZphXbmvJuujSNvieg1TNbuBgg-QZYJwM2-1qETawY9i35OWrfZE5KXEKWvoCALDlWG3zp1ndrLrymC0qzYuvyBvlEmmBs723sBdn7B
