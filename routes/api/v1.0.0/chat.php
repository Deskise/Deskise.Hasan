<?php

use App\Http\Controllers\Api\V1_0_0\ChatController as Chat;

Route::get('rules', [Chat::class, 'getRules']);

Route::get('list', [Chat::class, 'getChats']);
Route::get('blocked', [Chat::class, 'getBlockedChats']);

Route::group(['prefix' => '{chat}'], function (){

    Route::get('messages', [Chat::class, 'getMessages']);
    Route::get('files', [Chat::class, 'getFiles']);
    Route::get('agreements', [Chat::class, 'getAgreements']);

    Route::post('send/{type}', [Chat::class, 'message'])->where(['type'=>'(agreement|message|call|attachment|textphoto)']);
    
    Route::post('report',[Chat::class, 'report']);
    Route::get('block',[Chat::class, 'block']);
    Route::get('unblock',[Chat::class, 'unblock']);
});