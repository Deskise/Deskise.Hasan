<?php

use App\Http\Controllers\Admin\AdminController;

Route::resource('/administration', AdminController::class)->except('show')->middleware('AdminRole:super');

