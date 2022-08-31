<?php

use App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\ProductRequestsController;

Route::resource('/products', ProductController::class)->except('show')->middleware('AdminRole:super,product');
Route::get('/categories',[ProductController::class, 'getProductCategories'])->name('categories')->middleware('AdminRole:super,product');

Route::group([
    'prefix' => 'productRequests',
    'middleware' => 'AdminRole:super,product'
],function(){
    Route::get('/',[ProductRequestsController::class,'index'])->name('productRequests');
    Route::put('/approveProductRequest/{productRequest}',[ProductRequestsController::class,'approveProductRequest'])->name('approveProductRequest');
    Route::put('/rejectProductRequest/{productRequest}',[ProductRequestsController::class,'rejectProductRequest'])->name('rejectProductRequest');
});
