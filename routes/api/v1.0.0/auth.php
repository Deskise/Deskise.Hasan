<?php

use App\Http\Controllers\Api\V1_0_0\Auth\AuthController as Auth;

Route::post('/signup', [Auth::class, "signup"]);

Route::post('/verify/{type}',[Auth::class, "verify"])->middleware('HaveType:email');
Route::post('/verify/{type}/resend',[Auth::class, "resendVerification"])->middleware('HaveType:email');

Route::post('/login', [Auth::class, "login"]);
Route::post('/login/facebook', [Auth::class, "loginByFacebook"]);
Route::post('/login/google', [Auth::class, "loginByGoogle"]);

Route::post('/forget',[Auth::class, "forget"]);
Route::post('/reset',[Auth::class, "reset"]);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', [Auth::class, "logout"]);

    Route::get('user',[Auth::class, "user"]);
    Route::get('user/settings',[Auth::class, "userSettings"]);
});
