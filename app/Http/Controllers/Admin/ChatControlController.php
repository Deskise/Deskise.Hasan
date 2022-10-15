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
        $block_words = ChatControl::all('blocked_keywords')->first();
        $shitWords = $block_words->blocked_keywords;

        return response()->view('admin.chatControl.index',compact('chatConf','shitWords'));
    }


    // TODO: Don't Forget To Finish These Fuckin Shit!!
    public function update(Request $request){

        $data = ChatControl::get()->first();
        $data->update([
            'block_phones' => $request->has('block_phones'),
            'block_email' => $request->has('block_email'),
            'blocked_keywords' => explode(',', $request->get('blocked_keywords'))
        ]);

        return redirect()->route('admin.chatControl.index')->with('msg', 's:Updated Successfully');


    }

}
