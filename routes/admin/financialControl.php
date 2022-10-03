<?php

use App\Http\Controllers\Admin\FinancialControlController;

Route::resource('/financialControl', FinancialControlController::class)->middleware('AdminRole:super');
