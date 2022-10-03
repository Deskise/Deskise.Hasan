<?php

use App\Http\Controllers\Admin\CategoriesController;

Route::get('/create',[CategoriesController::class,'CreateCategory'])->name('create')->middleware('AdminRole:super');
