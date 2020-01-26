<?php

namespace App\Http\Controllers\Api;

use App\Htpp\Traits\ValidateAndCreatePatient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;
use MiladRahimi\LaraJwt\Facades\JwtAuth;

class AuthController extends Controller
{
    use ValidateAndCreatePatient;

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

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Auth::guard('api')->login($user);

        $jwt = JwtAuth::generateToken($user);
        $success = true;
        return compact('success', 'user', 'jwt');
    }
}
