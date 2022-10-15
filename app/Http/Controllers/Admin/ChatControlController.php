<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChatControl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChatControlController extends Controller
{

    public function index()
    {
        //
        $chatConf = ChatControl::all();
        return response()->view('admin.chatControl.index',compact('chatConf'));
    }

    // TODO: Don't Forget To Finish These Fuckin Shit!!
    function blockphones(Request $request,ChatControl $chatControl)
    {
        # code...
        $data = $request->has('blockPhones');
        dump($data);

    }


    function blockemails(Request $request,ChatControl $chatControl)
    {
        # code...

    }

}
