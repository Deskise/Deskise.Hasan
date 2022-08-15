<?php

use App\Http\Controllers\Admin\UserController;

Route::resource('/users', UserController::class)->except('show')->middleware('AdminRole:super');

