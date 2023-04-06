<?php
use \App\Http\Controllers\Api\V1_0_0\DataController as Data;

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

Route::get('/users/{id}', [Data::class,'user']);
Route::get('/users/{user}/products', [Data::class,'products']);






