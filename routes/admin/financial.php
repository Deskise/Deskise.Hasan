<?php

use App\Http\Controllers\Admin\FinancialController;

Route::get('/financial',[ FinancialController::class,'index'])->name('financial.index')->middleware('AdminRole:super');
