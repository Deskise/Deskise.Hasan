<?php

use App\Http\Controllers\Admin\FinancialControlController;

Route::get('/financialControl',[FinancialControlController::class,'index'])->name('financialControl.index')->middleware('AdminRole:super');
Route::put('/financialControl/updateProfitRate/{setting}',[FinancialControlController::class,'updateProfitRate'])->name('financialControl.updateProfitRate')->middleware('AdminRole:super');
Route::put('/financialControl/updateTaxRate/{setting}',[FinancialControlController::class,'updateTaxRate'])->name('financialControl.updateTaxRate')->middleware('AdminRole:super');
Route::put('/financialControl/updateBankCommission/{setting}',[FinancialControlController::class,'updateBankCommission'])->name('financialControl.updateBankCommission')->middleware('AdminRole:super');
Route::put('/financialControl/updateWithdrawLimits/{setting}',[FinancialControlController::class,'updateWithdrawLimits'])->name('financialControl.updateWithdrawLimits')->middleware('AdminRole:super');

