<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        return redirect(route('admin.getProducts'));
    }
    public function reject($id){
        Product::query()->findOrFail($id)->update([
            'status' => 'canceled'
        ]);
        \Session::flash("msg","Product rejected successfully");
        return redirect(route('admin.getProducts'));

    }


  public function acceptProduct(Request $request){

       $url = $request->url ;
       $id = $request->id ;

      Product::query()->findOrFail($id)->update([
          'status' => 'available'
      ]);

        $product =Product::where('id' ,$id)->first();
        if( $product){
            $user = $product->user ;
            //now will send email to user
            Mail::send('emails.acceptproduct', ['url' =>   $url ], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Add Your Request');
            });
        }

        $data['status'] = true;
        return response()->json( $data);


  }
}
