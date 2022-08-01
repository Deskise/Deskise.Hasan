<?php

namespace App\Http\Controllers\Api\V1_0_0;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getRules()
    {
        return 'rules';
    }

    public function getChats()
    {
        return APIHelper::jsonRender('', \request()->user('api')->chats);
    }

    public function getMessages(Chat $chat)
    {
        dump($chat);
        return 'messages';
    }

    public function getFiles(Chat $chat)
    {
        return 'files';
    }

    public function getAgreements(Chat $chat)
    {
        return 'agreements';
    }
}
