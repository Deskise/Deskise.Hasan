<?php

use App\Http\Controllers\Admin\ProductController;


Route::resource('/products', ProductController::class)->except('show')->middleware('AdminRole:super,product');
Route::get('/categories',[ProductController::class, 'getProductCategories'])->name('categories')->middleware('AdminRole:super,product');
Route::get('/pageRequests',[ProductController::class, 'getProductRequests'])->name('pageRequests')->middleware('AdminRole:super,product');

