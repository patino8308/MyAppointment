<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');


//RECURSOS PUBLICOS
Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties/{specialty}/doctors', 'SpecialtyController@doctors');
Route::get('/schedule/hours', 'ScheduleController@hours');

Route::middleware('auth:api')->group(function () {

    Route::get('/user', 'UserController@show');
    Route::post('/logout', 'AuthController@logout');

    //appointments
    Route::post('/appointments', 'AppointmentsController@store');
    Route::get('/appointments', 'AppointmentsController@index');

    //FCM
    Route::get('/fcm/token', 'FirebaseController@postToken');
});
