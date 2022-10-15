<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class FinancialController extends Controller
{

    public function index()
    {
        //
        $sales = Product::where('status','=','sold')->paginate(7);
        $prices = Product::where('status','=','sold')->get();
        $profitRate = Setting::findOrFail(1)->value;
        $catPrice = [];
        foreach($prices as $p) {
            // dump($p->category->name_en);

            if(in_array($p->category->name_en,$catPrice) == false){
                $catId = $p->category_id;
                $catPr = Product::where([['status','=','sold'],['category_id','=',$catId]])->sum('price');
                $catPrice[$p->category->name_en] = $catPr;
            }
        }
        return response()->view('admin.finincial.index',compact('sales','catPrice','profitRate'));
    }

}
