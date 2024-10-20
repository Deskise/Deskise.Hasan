<?php

use App\Http\Controllers\Admin\PackagesController;

Route::resource('/packages', PackagesController::class)->except('show')->middleware('AdminRole:super');

