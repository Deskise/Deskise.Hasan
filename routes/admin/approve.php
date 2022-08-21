<?php

use App\Http\Controllers\Admin\ApproveController;
use App\Http\Controllers\Admin\ApproveUserIdController;

Route::post('/acceptProduct', [ApproveController::class, 'acceptProduct'])->name('acceptProduct');

Route::group([
    'prefix' => 'get_products',
    'middleware' => 'AdminRole:super,verify'
],function () {

    Route::get('/', [ApproveController::class, 'getProducts'])->name('getProducts');
    Route::get('/verify/{product_id}', [ApproveController::class, 'verify'])->name('get_products.verify');
    Route::get('/reject/{product_id}', [ApproveController::class, 'reject'])->name('reject');
});

Route::group([
    'prefix' => 'get_user_IDs',
    'middleware' => 'AdminRole:super,verify'
],function () {
    Route::get('/', [ApproveUserIdController::class, 'getUserIDs'])->name('getUserIDs');
    Route::get('/verify_ID/{user}', [ApproveUserIdController::class, 'verifyID'])->name('verifyID');
    Route::get('/reject_ID/{user}', [ApproveUserIdController::class, 'rejectID'])->name('rejectID');
});