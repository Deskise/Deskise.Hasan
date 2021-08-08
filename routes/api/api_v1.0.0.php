<?php

    use App\Helpers\APIHelper;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

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

const VERSION = "v1.0.0";

// Auth things:
Route::group(['prefix' => 'auth', 'name'=>'api.v1.auth.'], function(){
    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('signup', 'Auth\AuthController@signup')->name('signup');
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'Auth\AuthController@user')->name('user');
    Route::get('logout', 'Auth\AuthController@logout')->name('logout');
});


// API Data things:
Route::group(
    [
        'prefix'    =>  'data',
        'name'      =>  'api.v1.data.'
    ], function (){

        Route::get('/terms&conditions', 'DataController@termsandconditions')->name('terms');
        Route::get('/privacy', 'DataController@privacy')->name('privacy');
        Route::get('/packages','DataController@packages')->name('packages');
        Route::get('/categories','DataController@categories')->name('categories');
        Route::get('/subcategories/{category?}','DataController@subcategories')->name('subcategories');
        Route::get('/comments','DataController@comments')->name('comments');
        Route::get('/version','DataController@version')->name('version');

        Route::post('/contactus','DataController@contact')->name('contact');

    });

Route::group(
    [
        'prefix'    =>  'products',
        'name'      =>  'api.v1.products.'
    ], function (){

        Route::post('request','productController@request');

        Route::get('list','productController@list');
        Route::get('/single/{product}','productController@single');

    });

    Route::fallback(function(){
        return APIHelper::jsonRender('404 not Found', [],400);
    })->name('api.fallback.404');
