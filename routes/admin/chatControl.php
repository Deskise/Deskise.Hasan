<?php

use App\Http\Controllers\Admin\ChatControlController;

Route::resource('/chatControl', ChatControlController::class)->middleware('AdminRole:super,chat');

