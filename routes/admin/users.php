<?php

use App\Http\Controllers\Admin\UserController;

//Route::resource('/users', UserController::class)->except('show')->middleware('AdminRole:super');
Route::get('/users',[UserController::class,'index'])->middleware('AdminRole:super')->name('users.index');
Route::get('/users/{user}/change_ban',[UserController::class,'update'])->middleware('AdminRole:super')->name('users.update');
Route::get('/users/{user}',[UserController::class,'show'])->middleware('AdminRole:super')->name('users.show');
Route::get('/users/{user}/chats',[UserController::class,'userChat'])->middleware('AdminRole:super')->name('users.chat');
Route::get('/users/{user}/reports',[UserController::class,'userReports'])->middleware('AdminRole:super')->name('users.reports');
