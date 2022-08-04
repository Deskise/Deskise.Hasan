<?php
use App\Http\Controllers\Admin\AboutUsController;

Route::prefix('about_us')->middleware('AdminRole:super,content')->group(function () {
    Route::get('/', [AboutUsController::class, 'about_us'])->name('about');
    Route::post('/', [AboutUsController::class, 'about_us_update'])->name('edit');
});

Route::prefix('terms')->middleware('AdminRole:super,content')->group(function () {
    Route::get('/', [AboutUsController::class, 'term_of_use'])->name('terms');
    Route::post('/', [AboutUsController::class, 'term_of_use_update'])->name('edit_terms');
});

Route::prefix('privacy')->middleware('AdminRole:super,content')->group(function () {
    Route::get('/', [AboutUsController::class, 'privacy_policy'])->name('privacy');
    Route::post('/', [AboutUsController::class, 'privacy_policy_update'])->name('privacy_update');
});
