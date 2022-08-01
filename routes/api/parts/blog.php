<?php

use \App\Http\Controllers\Api\V1_0_0\BlogController as Blog;


Route::get('posts', [Blog::class, 'posts']);
Route::get('posts/category/{category}', [Blog::class,'category']);

Route::get('post/{post}', [Blog::class,'post']);
Route::get('post/{post}/like', [Blog::class,'like']);

Route::get('search',[Blog::class,'search']);
