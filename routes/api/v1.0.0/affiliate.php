<?php

use \App\Http\Controllers\Api\V1_0_0\AffiliateController;

Route::get('/', [AffiliateController::class, 'index']);
Route::post('save', [AffiliateController::class, 'save']);
Route::post('toggle-affiliate-links', [AffiliateController::class, 'toggleAffiliateLinks']);