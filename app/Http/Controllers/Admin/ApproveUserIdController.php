<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ApproveUserIdController extends Controller
{
    public function getUserIDs(){
//        $users = UserID::query()->where('status', '=','under_verify')->orderByDesc('created_at')->get();
//        return view('admin.UserID.user_id',compact('users'));
    }

    public function verifyID($id){
       //dd('man');
//        UserID::query()->findOrFail($id)->update([
//            'status' => 'verify'
//        ]);
//        \Session::flash("msg","User verify successfully");
//        return redirect(route('admin.getUserIDs'));
    }
    public function rejectID($id){
//        UserID::query()->findOrFail($id)->update([
//            'status' => 'reject'
//        ]);
//        \Session::flash("msg","User rejected successfully");
//        return redirect(route('admin.getUserIDs'));

    }
}
