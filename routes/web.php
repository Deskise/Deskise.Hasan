<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AdminBlogPostController;
use App\Http\Controllers\Admin\ApproveController;
use App\Http\Controllers\Admin\ApproveUserIdController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
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





Route::get('{for}/images/{image}', function ($for, $image) {
    return Storage::disk($for)->download($image);
})->name('images');

Route::get('/send', function () {
    broadcast(new \App\Events\NewNotification('hiiiiiiiiiii'));
    return 'yes';
});


Route::prefix('admin')->group(function () {
    Route::redirect('/', '/login');
    Auth::routes(['register' => false]);
});

Route::resource('admin/blog_posts', AdminBlogPostController::class);
Route::get("admin/blog_posts/{id}",[AdminBlogPostController::class,'destroy'])->name("blog_posts.delete");
//Hala and omar
Route::resource('/settings' , SettingsController::class);
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {



   // Route::resource('blog-posts', 'AdminBlogPostController');
    //Route::get("blog_posts/{id}",[AdminBlogPostController::class,'destroy'])->name("blog_posts.delete");

    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');
    Route::put('/edit_home/{id}', [DashboardController::class, 'editHome'])->name('edit_home');


    Route::get('/checkidentity', [DashboardController::class, 'checkidentity'])->name('dashboard');

    Route::prefix('about_us')->group(function () {
        Route::get('/', [AboutUsController::class, 'about_us']);
        Route::post('/', [AboutUsController::class, 'about_us_update'])->name('edit');
    });

    Route::prefix('terms')->group(function () {
        Route::get('/', [AboutUsController::class, 'term_of_use']);
        Route::post('/', [AboutUsController::class, 'term_of_use_update'])->name('edit_terms');
    });

    Route::prefix('privacy')->group(function () {
        Route::get('/', [AboutUsController::class, 'privacy_policy']);
        Route::post('/', [AboutUsController::class, 'privacy_policy_update'])->name('privacy_update');
    });





    Route::post('/acceptProduct', [ApproveController::class, 'acceptProduct'])->name('acceptProduct');
    Route::prefix('get_products')->group(function () {
        Route::get('/', [ApproveController::class, 'getProducts'])->name('getProducts');
        Route::get('/verify/{product_id}', [ApproveController::class, 'verify'])->name('get_products.verify');
        Route::get('/reject/{product_id}', [ApproveController::class, 'reject'])->name('reject');
    });



    Route::prefix('get_user_IDs')->group(function () {
        Route::get('/', [ApproveUserIdController::class, 'getUserIDs'])->name('getUserIDs');
        Route::get('/verify_ID/{user_id}', [ApproveUserIdController::class, 'verifyID'])->name('verifyID');
        Route::get('/reject_ID/{user_id}', [ApproveUserIdController::class, 'rejectID'])->name('rejectID');
    });


});
