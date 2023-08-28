<?php

use App\Http\Controllers\Admin\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->middleware('AdminRole:super')->name('contact.index');
// Route::delete('/contact/destroy/{msg}', [ContactController::class, 'destroy'])->middleware('AdminRole:super')->name('admin.contactUs.destroy');
Route::delete('/contact/destroy/{msg}', [ContactController::class, 'destroy'])
    ->middleware('AdminRole:super')
    ->name('contactUs.destroy');
