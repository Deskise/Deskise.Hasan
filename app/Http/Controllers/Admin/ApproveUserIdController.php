<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ApproveUserIdController extends Controller
{
    public function getUserIDs(){
        $users = User::whereHas('assets')->whereNull('id_verified_at')->get();
        return response()->view('admin.UserID.user_id',compact('users'));
    }

    public function verifyID(User $user){
        $user->update([
            'id_verified_at' => now()
        ]);
        \Session::flash("msg","User verify successfully");
        return redirect(route('admin.getUserIDs'));
    }
    public function rejectID(User $user, Request $request){
        $request->validate([
            'massage' => 'string|min:100|max:2500'
        ]);

        $user->assets->update([
            'rejectMessage' => $request->input('massage')
        ]);

        \Session::flash("msg","User rejected successfully");
        return redirect(route('admin.getUserIDs'));

    }
}
