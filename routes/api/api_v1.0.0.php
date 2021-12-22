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

// API Data things:
Route::group(['prefix' => 'data'], function (){
    Route::group(['prefix' => 'terms'], function (){
        Route::get('/terms', 'DataController@termsandconditions');
        Route::get('/privacy', 'DataController@privacy');
    });

    Route::group(['prefix' => 'categories'], function (){
        Route::get('/{category?}','DataController@categories');
        Route::get('/{category}/subcategories','DataController@subcategories');
    });

    Route::group(['prefix' => 'api'], function (){
        Route::get('/version','DataController@version');
    });

    Route::group(['prefix' => 'about'], function (){
        Route::get('/home','DataController@aboutHome');
        Route::get('/page','DataController@aboutPage');
    });

    Route::get('/packages','DataController@packages');
    Route::get('/comments','DataController@comments');
    Route::get('/faq','DataController@faq');
    Route::post('/newsletter','DataController@news');

    Route::post('/contactus','DataController@contact');
    Route::get('/social','DataController@social');

});

// Blog Things:
Route::group(['prefix' => 'blog'], function (){

  Route::get('posts', 'BlogController@posts');
  Route::get('posts/category/{category}', 'BlogController@category');

  Route::get('post/{post}', 'BlogController@post');
  Route::get('post/{post}/like', 'BlogController@like');

  Route::get('search','BlogController@search');

});

// Auth things:
Route::group(['prefix' => 'auth'], function(){

    Route::post('/signup', 'Auth\AuthController@signup');
//    Route::post('/signup/facebook', 'Auth\AuthController@signupByFacebook');
//    Route::post('/signup/google', 'Auth\AuthController@signupByGoogle');

    Route::post('/verify/{type}','Auth\AuthController@verify')->middleware('HaveType:email');
    Route::post('/verify/{type}/resend','Auth\AuthController@resendVerification')->middleware('HaveType:email');

    Route::post('/login', 'Auth\AuthController@login');
    Route::post('/login/facebook', 'Auth\AuthController@loginByFacebook');
    Route::post('/login/google', 'Auth\AuthController@loginByGoogle');

    Route::post('/forget','Auth\AuthController@forget');
    Route::post('/reset','Auth\AuthController@reset');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Auth\AuthController@logout');

        Route::get('user','Auth\AuthController@user');
    });
});

// Product things:
Route::group(['prefix' => 'products'], function (){

    Route::post('request','productController@request');
    Route::get('request','productController@best');

    Route::get('list/{category?}','productController@list');
    Route::get('single/{id}','productController@single');
    Route::get('single/{product}/like','productController@like');
    Route::get('search','productController@search');
    Route::get('best','productController@best');

    Route::get('edit/{id}','productController@edit');
    Route::post('edit/{id}/publish','productController@publish');
    Route::post('edit/{id}/save','productController@saveDraft');
    Route::post('edit/{id}/upload','productController@upload');

    Route::post('add','productController@publish')->name('add');
    Route::post('add/save','productController@saveDraft');
});

// Status Fallback:
Route::fallback(function(){
    return APIHelper::jsonRender('404 not Found', [],404);
})->name('api.fallback.404');
