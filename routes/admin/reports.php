<?php
use App\Http\Controllers\Admin\ChatReportController;


Route::get('/reports', [ChatReportController::class,'index'])->name("reports.index")->middleware('AdminRole:super,chat');
Route::get('/reports/{id}', [ChatReportController::class,'show'])->name("reports.show")->middleware('AdminRole:super,chat');

