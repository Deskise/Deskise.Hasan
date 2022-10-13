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
//Route::get('/', fn () => Hash::make('password'));

Route::get('{for}/images/{image}', function ($for, $image) {
    if (str_contains($for,'.'))
    {
        $e = explode('.',$for);
        $for = $e[0];
        $image = implode(DIRECTORY_SEPARATOR,array_slice($e,1)). DIRECTORY_SEPARATOR . $image;
    }
    return Storage::disk($for)->download($image);
})->name('images');

Route::resource('/settings' , SettingsController::class);

Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['register' => false]);

    Route::group(['as' => 'admin.', 'middleware' => ['auth']], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::resource('/settings' , SettingsController::class)->middleware('AdminRole:super');
        Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');
        Route::put('/edit_home/{id}', [DashboardController::class, 'editHome'])->name('edit_home');

        require 'admin/aboutUs.php';
        require 'admin/approve.php';
        require 'admin/blog.php';
        require 'admin/administration.php';
        require 'admin/reports.php';
        require 'admin/users.php';
        require 'admin/products.php';
        require 'admin/packages.php';
        require 'admin/chatControl.php';
        require 'admin/financialControl.php';
        require 'admin/financial.php';

        Route::group(['as'=>'category.'], fn () => require 'admin/category.php');
    });
});
