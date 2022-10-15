<?php

use App\Http\Controllers\Admin\ChatControlController;

Route::get('/chatControl', [ChatControlController::class,'index'])->name('chatControl.index')->middleware('AdminRole:super,chat');
