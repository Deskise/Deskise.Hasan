<?php

use App\Http\Controllers\Admin\ApproveUserIdController;

Route::group([
    'prefix' => 'get_user_IDs',
    'middleware' => 'AdminRole:super,verify'
],function () {
    Route::get('/', [ApproveUserIdController::class, 'getUserIDs'])->name('getUserIDs');
    Route::get('/verify_ID/{user}', [ApproveUserIdController::class, 'verifyID'])->name('verifyID');
    Route::get('/reject_ID/{user}', [ApproveUserIdController::class, 'rejectID'])->name('rejectID');
});
