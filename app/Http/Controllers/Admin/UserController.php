<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        //
        $allUsers = User::paginate(10);
        return response()->view('admin.users.index',['allUsers'=>$allUsers]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        //

        return response()->view('admin.users.showUser',['user'=>$user]);


    }


    public function edit($id)
    {
        //
    }


    public function update(User $user)
    {
        $user->update([
            'banned'=> !$user->banned
        ]);

        return redirect()->back()->with('msg','s:Updated Successfully!');
    }


    public function destroy($id)
    {
        //
    }


    public function userChat(User $user){
        return response()->view('admin.users.userChats');
    }

    public function userReports(User $user){
        return response()->view('admin.users.userReports');
    }

}
