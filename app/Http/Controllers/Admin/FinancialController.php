<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FinancialController extends Controller
{

    public function index()
    {
        //
        $sales = Product::where('status','=','sold')->paginate(10);
        $prices = Product::where('status','=','sold')->get();
        $catPrice = [];
        foreach($prices as $p) {
            // dump($p->category->name_en);

            if(in_array($p->category->name_en,$catPrice) == false){
                $catId = $p->category_id;
                // dump($catId);
                $catPr = Product::where([['status','=','sold'],['category_id','=',$catId]])->sum('price');
                // dump($catPr);
                $catPrice[$p->category->name_en] = $catPr;
            }
        }
        // dump($catPrice);

        return response()->view('admin.finincial.index',compact('sales','catPrice'));
    }



}
