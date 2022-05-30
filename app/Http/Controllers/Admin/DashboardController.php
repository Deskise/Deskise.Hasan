<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Chat;
use App\Models\ChatAgreement;
use App\Models\HomeText;
use App\Models\ProductBuy;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){
        $new_users = User::query()
            ->whereMonth('created_at',now()->format('m'))
            ->count();

        $users = User::query()->count();

        $chats = Chat::query()->count();
        $chat_agrees = ChatAgreement::query()->count();

        $ProductBuy = ProductBuy::query()->count();

      //  $this_month =

        return view('dashboard.admin',compact('new_users','users','chats','chat_agrees','ProductBuy'));
    }

    public function setting(){
        $texts = HomeText::query()->get();
        return view('admin.AboutUs.setting',compact('texts'));
    }

    public function checkidentity(){
        dd( 'mm' );
    }

    public function editHome($id){
        HomeText::find($id)->update([
            'value' => request('value')
        ]);
        return redirect(route('setting'));
    }
}

