<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function index()
    {
        //
        $adminUsers = Admin::all();
        return response()->view('admin.administration.index',compact('adminUsers'));
    }


    public function create()
    {
        //

        return response()->view('admin.administration.create');
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'firstname'=>'required|string|min:3|max:20',
            'lastname'=>'required|string|min:3|max:20',
            'bio'=>'string|nullable|max:600',
            'email'=>'email|required',
            'password'=>'string|required|min:8|max:20',
            'role'=>'required|in:'.implode(',',['super','chat','verify','blog','product','content'])
        ]);

        if (Admin::create($request->all())){
            return redirect()->route('admin.administration.index');
        }

        return redirect()->back();

    }


    public function edit(Admin $administration)
    {
        return response()->view('admin.administration.edit',['adminUser' => $administration]);
    }


    public function update(Request $request, Admin $administration)
    {

        $request->validate([
            'firstname'=>'required|string|min:3|max:20',
            'lastname'=>'required|string|min:3|max:20',
            'bio'=>'string|nullable|max:600',
            'img'=>'file|mimes:jpg,jpeg,png,webp',
            'email'=>'email|required',
            'password'=>'string|nullable|min:8|max:20',
            'role'=>'required|in:'.implode(',',['super','chat','verify','blog','product','content'])
        ]);

        $administration->firstname = $request->input('firstname');
        $administration->lastname = $request->input('lastname');
        $administration->bio = $request->input('bio');
        $administration->email = $request->input('email');
        $administration->role = $request->input('role');

        if ($pass = $request->input('password')) $administration->password = $pass;
        if ($request->file('img')){
            if ($administration->img !== 'default.png') {
                \Storage::disk('admin')->delete($administration->img);
            }
            $administration->img = \Storage::disk('admin')->put('',$request->file('img'));
        }

        if ($administration->save()){
            return redirect()->route('admin.administration.index');
        }

        return redirect()->back();
    }


    public function destroy(Admin $administration)
    {
        //
        $administration->delete();
        \Session::flash("msg","Admin Deleted successfully");
        return redirect()->route('admin.administration.index');

    }
}
