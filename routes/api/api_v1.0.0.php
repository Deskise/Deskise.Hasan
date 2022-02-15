<?php

    use App\Helpers\APIHelper;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use \App\Http\Controllers\Api\V1_0_0\DataController as Data;
    use \App\Http\Controllers\Api\V1_0_0\ProfileController as Profile;
    use App\Http\Controllers\Api\V1_0_0\ProductController as Product;

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
        Route::get('/terms', [Data::class,'termsandconditions']);
        Route::get('/privacy', [Data::class,'privacy']);
    });

    Route::group(['prefix' => 'categories'], function (){
        Route::get('/{category?}',[Data::class,'categories']);
        Route::get('/{category?}/subcategories',[Data::class,'subcategories']);
    });

    Route::group(['prefix' => 'api'], function (){
        Route::get('/version',[Data::class,'version']);
    });

    Route::group(['prefix' => 'about'], function (){
        Route::get('/home',[Data::class,'aboutHome']);
        Route::get('/page',[Data::class,'aboutPage']);
    });

    Route::get('/packages',[Data::class,'packages']);
    Route::get('/comments',[Data::class,'comments']);
    Route::get('/faq',[Data::class,'faq']);
    Route::post('/newsletter',[Data::class,'news']);

    Route::post('/contactus',[Data::class,'contact']);
    Route::get('/social',[Data::class,'social']);

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
        Route::get('user/settings','Auth\AuthController@userSettings');
    });
});
Route::group([
    'prefix' => 'dashboard',
    'middleware' => 'auth:api'
], function() {
    Route::post('/user/data', [Profile::class, 'userData']);
    Route::post('/user/alerts', [Profile::class, 'alerts']);
    Route::post('/user/password/change', [Profile::class, 'changePassword']);
    Route::post('/user/account/close', [Profile::class, 'closeAccount']);
});

// Product things:
Route::group(['prefix' => 'products'], function (){

    Route::post('request',[Product::class,'request']);
    Route::get('request',[Product::class,'best']);

    Route::get('list/{category?}',[Product::class,'list']);
    Route::get('single/{id}',[Product::class,'single']);
    Route::get('single/{product}/like',[Product::class,'like']);
    Route::get('search',[Product::class,'search']);
    Route::get('best',[Product::class,'best']);

    Route::get('edit/{id}',[Product::class,'edit']);
    Route::post('edit/{id}/publish',[Product::class,'publish']);
    Route::post('edit/{id}/save',[Product::class,'saveDraft']);
    Route::post('edit/{id}/upload',[Product::class,'upload']);

    Route::post('add',[Product::class,'publish'])->name('add');
    Route::post('add/save',[Product::class,'saveDraft']);
});

// Status Fallback:
Route::fallback(function(){
    return APIHelper::jsonRender('404 not Found', [],404);
})->name('api.fallback.404');
