<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MiladRahimi\LaraJwt\Facades\JwtAuth;

class UserController extends Controller
{
    public function show()
    {
        return Auth::guard('api')->user();
    }

    public function update(Request $request)
    {
        $user =  Auth::guard('api')->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        JwtAuth::clearCache($user);
    }
}
