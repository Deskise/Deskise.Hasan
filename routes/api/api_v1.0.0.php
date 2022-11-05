<?php

    use App\Helpers\APIHelper;
    use Illuminate\Support\Facades\Route;
    use \App\Http\Controllers\Api\V1_0_0\ProfileController as Profile;
    use \App\Http\Controllers\Api\V1_0_0\MainController as main;

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
if (PHP_SAPI !== 'cli'){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
    header('Access-Control-Allow-Headers: Accept, Authorization, Content-Type, X-Requested-With');
}

// API Data things:
Route::group(['prefix' => 'data'], fn () => require 'v1.0.0/data.php');

// Blog Things:
Route::group(['prefix' => 'blog'], fn () => require 'v1.0.0/blog.php');

// Auth things:
Route::group(['prefix' => 'auth'], fn () => require 'v1.0.0/auth.php');

// Product things:
Route::group(['prefix' => 'products'], fn () => require 'v1.0.0/products.php');

// Chat:
Route::group(['prefix' => 'chat', 'middleware' => 'auth:api'], fn () => require 'v1.0.0/chat.php');

// Dashboard Things
Route::group([
    'prefix' => 'dashboard',
    'middleware' => 'auth:api'
], function() {
    Route::post('/user/data', [Profile::class, 'userData']);
    Route::post('/user/alerts', [Profile::class, 'alerts']);
    Route::post('/user/password/change', [Profile::class, 'changePassword']);
    Route::post('/user/account/close', [Profile::class, 'closeAccount']);
});

Route::group([
    'prefix' => 'main',
    'middleware' => 'auth:api'
], function () {
    Route::post('upload',[main::class,'upload']);
});

// Try Broadcasting Events:
Route::get('/send', function () {
    broadcast(new \App\Events\NewNotification('hiiiiiiiiiii'));
    return APIHelper::jsonRender('yes', []);
})->middleware('auth:api');

// Status Fallback:
Route::fallback(function(){
    return APIHelper::jsonRender('404 not Found', [],404);
})->name('api.fallback.404');

