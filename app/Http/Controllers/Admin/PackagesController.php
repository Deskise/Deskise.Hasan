<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{

    public function index()
    {
        //
        $packages = Package::paginate(15);
        return response()->view('admin.packages.index',compact('packages'));
    }


    public function create()
    {
        //
        return response()->view('admin.packages.create');
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'name_en'=>'required|string|min:3',
            'price'=>'required|numeric',
            'duration'=>'required|in:'.implode(',',['days','per product','every product']),
            'dur'=>'required|numeric',
            'details_en'=>'string|nullable|max:600',
        ]);

        if (Package::create($request->all())){
            \Session::flash("msg","Package Created successfully");
            return redirect()->route('admin.packages.index');
        }

        return redirect()->back();
    }


    public function edit(Package $package)
    {
        //
        return response()->view('admin.packages.edit',['package'=>$package]);
    }


    public function update(Request $request, Package $package)
    {
        //
        if ($package->update($request->all())){
            \Session::flash("msg","The Package Updated successfully");
            return redirect()->route("admin.packages.index");

        }
        return redirect()->back();
    }


    public function destroy(Package $package)
    {
        //
        $package->delete();
        \Session::flash("msg","Package Deleted successfully");
        return redirect()->route('admin.packages.index');
    }
}
