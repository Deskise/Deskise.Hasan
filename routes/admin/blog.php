<?php
use App\Http\Controllers\Admin\BlogPostController;

Route::resource('/blogs',BlogPostController::class)->middleware('AdminRole:super,blog');

//Route::get("/blog_posts/{id}",[BlogPostController::class,'destroy'])->name("blog_posts.delete")->middleware('AdminRole:super,blog');