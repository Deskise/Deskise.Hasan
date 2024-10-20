<?php

use App\Http\Controllers\Admin\FinancialControlController;
use \App\Http\Controllers\Api\V1_0_0\PaymentController;

Route::get('/financialControl',[FinancialControlController::class,'index'])->name('financialControl.index')->middleware('AdminRole:super');
Route::put('/financialControl/updateProfitRate/{setting}',[FinancialControlController::class,'updateProfitRate'])->name('financialControl.updateProfitRate')->middleware('AdminRole:super');
Route::put('/financialControl/updateTaxRate/{setting}',[FinancialControlController::class,'updateTaxRate'])->name('financialControl.updateTaxRate')->middleware('AdminRole:super');
Route::put('/financialControl/updateBankCommission/{setting}',[FinancialControlController::class,'updateBankCommission'])->name('financialControl.updateBankCommission')->middleware('AdminRole:super');
Route::put('/financialControl/updateWithdrawLimits/{setting}',[FinancialControlController::class,'updateWithdrawLimits'])->name('financialControl.updateWithdrawLimits')->middleware('AdminRole:super');
Route::put('/financialControl/updateAffiliateRate/{setting}',[FinancialControlController::class,'updateAffiliateRate'])->name('financialControl.updateAffiliateRate')->middleware('AdminRole:super');

// Withdraw
Route::get('/withdraw-requests', [PaymentController::class, 'withdrawList'])->name('withdrawRequests.index')->middleware('AdminRole:super');
Route::delete('/withdraw-requests/remove/{id}', [PaymentController::class, 'removeWithdraw'])->name('withdrawRequests.remove')->middleware('AdminRole:super');
Route::put('/withdraw-requests/approve/{id}', [PaymentController::class, 'approveWithdraw'])->name('withdrawRequests.approve')->middleware('AdminRole:super');
Route::put('/withdraw-requests/decline/{id}', [PaymentController::class, 'declineWithdraw'])->name('withdrawRequests.decline')->middleware('AdminRole:super');
