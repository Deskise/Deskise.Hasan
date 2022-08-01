<?php
use App\Http\Controllers\Admin\AboutUsController;

Route::prefix('about_us')->group(function () {
    Route::get('/', [AboutUsController::class, 'about_us']);
    Route::post('/', [AboutUsController::class, 'about_us_update'])->name('edit');
});

Route::prefix('terms')->group(function () {
    Route::get('/', [AboutUsController::class, 'term_of_use']);
    Route::post('/', [AboutUsController::class, 'term_of_use_update'])->name('edit_terms');
});

Route::prefix('privacy')->group(function () {
    Route::get('/', [AboutUsController::class, 'privacy_policy']);
    Route::post('/', [AboutUsController::class, 'privacy_policy_update'])->name('privacy_update');
});
