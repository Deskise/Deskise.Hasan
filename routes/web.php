<?php

use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

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





Route::get('{for}/images/{image}', function ($for, $image) {
    return Storage::disk($for)->download($image);
})->name('images');

Route::resource('/settings' , SettingsController::class);

Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['register' => false]);

    Route::group(['as' => 'admin.', 'middleware' => ['auth']], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');
        Route::put('/edit_home/{id}', [DashboardController::class, 'editHome'])->name('edit_home');

        require 'admin/aboutUs.php';
        require 'admin/blog.php';
        require 'admin/approve.php';
    });
});


// Try Broadcasting Events:
Route::get('/send', function () {
    broadcast(new \App\Events\NewNotification('hiiiiiiiiiii'));
    return 'yes';
});
