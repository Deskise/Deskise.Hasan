<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{for}/images/{image}',function ($for,$image){
    return Storage::disk($for)->download($image);
})->name('images');

Route::get('/send',function (){
    broadcast(new \App\Events\NewNotification('hiiiiiiiiiii'));
    return 'yes';
});
