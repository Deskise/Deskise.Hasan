<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ApproveController extends Controller
{
    public function getProducts(){
        $products = Product::query()->where('status', '=','under_verify')->orderByDesc('created_at')->get();
        return view('admin.Products.prdoucts',compact('products'));
    }

    public function verify($id){
        Product::query()->findOrFail($id)->update([
            'status' => 'available'
        ]);
        \Session::flash("msg","Product verify successfully");
        return redirect(route('getProducts'));
    }
    public function reject($id){
        Product::query()->findOrFail($id)->update([
            'status' => 'canceled'
        ]);
        \Session::flash("msg","Product rejected successfully");
        return redirect(route('getProducts'));

    }
}
