<?php
use App\Http\Controllers\Api\V1_0_0\ProductController as Product;

Route::post('request',[Product::class,'request']);

Route::get('list/{category?}',[Product::class,'list']);
Route::get('single/{id}',[Product::class,'single']);
Route::get('similar/{id}',[Product::class,'similar']);
Route::get('single/{product}/like',[Product::class,'like']);
Route::get('search',[Product::class,'search']);
Route::get('best',[Product::class,'best']);

Route::get('edit/{id}',[Product::class,'edit']);
Route::post('edit/{id}/publish',[Product::class,'publish']);
Route::post('edit/{id}/save',[Product::class,'saveDraft']);

// Route::post('edit/{id}/publish',[Product::class,'update']);

Route::post('add',[Product::class,'publish'])->name('add');
Route::post('add/save',[Product::class,'saveDraft']);
