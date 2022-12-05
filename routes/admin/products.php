<?php

use App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\ProductRequestsController;

Route::resource('/products', ProductController::class)->except('show,create,store')->middleware('AdminRole:super,product');
Route::get('/products/{category}/create', [ProductController::class,'create'])->name('products.create');
Route::post('/products/{category}/store', [ProductController::class,'store'])->name('products.store');
Route::get('/categories',[ProductController::class, 'getProductCategories'])->name('categories')->middleware('AdminRole:super,product');

Route::group([
    'prefix' => 'productRequests',
    'middleware' => 'AdminRole:super,product'
],function(){
    Route::get('/',[ProductRequestsController::class,'index'])->name('productRequests');
    Route::put('/approveProductRequest/{productRequest}',[ProductRequestsController::class,'approveProductRequest'])->name('approveProductRequest');
    Route::put('/rejectProductRequest/{productRequest}',[ProductRequestsController::class,'rejectProductRequest'])->name('rejectProductRequest');
});
