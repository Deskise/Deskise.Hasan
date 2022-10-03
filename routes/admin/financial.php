<?php

use App\Http\Controllers\Admin\FinancialController;

Route::resource('/financial', FinancialController::class)->middleware('AdminRole:super');
