<?php
use \App\Http\Controllers\Api\V1_0_0\PaymentController;

Route::post('create-payment', [PaymentController::class, 'createPayment']);
Route::get('user-sales/{id}', [PaymentController::class, 'userSales']);

Route::post('create-paymentintent', [PaymentController::class, 'createPaymentIntent']);

Route::get('confirm', [PaymentController::class, 'confirm']);

Route::post('create-connected-account', [PaymentController::class, 'createConnectedAccount']);

Route::get('get-withdraw-limit', [PaymentController::class, 'getWithdrawLimit']);
