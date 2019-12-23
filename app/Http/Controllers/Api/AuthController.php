<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MiladRahimi\LaraJwt\Facades\JwtAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credential =  $request->only('email', 'password');

        if (Auth::guard('api')->attempt($credential)) {
            $user = Auth::guard('api')->user();

            $jwt = JwtAuth::generateToken($user);
            $success = true;
            return compact('success', 'user', 'jwt');
            // Return successfull sign in response with the generated jwt.
        } else {
            // Return response for failed attempt...
            $success = false;
            $message = 'Invalid Credentials';
            return compact('success', 'message');
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout(false);
        $success = true;

        return compact('success');
    }
}
