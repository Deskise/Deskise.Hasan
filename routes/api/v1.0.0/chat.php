<?php

use App\Http\Controllers\Api\V1_0_0\ChatController as Chat;

Route::get('rules', [Chat::class, 'getRules']);

Route::get('list', [Chat::class, 'getChats']);
Route::group(['prefix' => '{chat}'], function (){

    Route::get('messages', [Chat::class, 'getMessages']);
    Route::get('files', [Chat::class, 'getFiles']);
    Route::get('agreements', [Chat::class, 'getAgreements']);

    Route::group(['prefix' => 'send'], function () {
        Route::post('message', [Chat::class, 'sendMessage']);
        Route::post('agreement', [Chat::class, 'sendAgreement']);
    });
});
