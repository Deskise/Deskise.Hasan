<?php

use App\Http\Controllers\Admin\ChatControlController;

Route::get('/chatControl', [ChatControlController::class,'index'])->name('chatControl.index')->middleware('AdminRole:super,chat');
Route::post('/chatControl', [ChatControlController::class,'index'])->name('chatControl.index')->middleware('AdminRole:super,chat');
Route::put('/chatControl/update', [ChatControlController::class,'update'])->name('chatControl.update')->middleware('AdminRole:super,chat');
