<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\ProductBuy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FinancialController extends Controller
{

    public function index()
    {
        $sales = ProductBuy::paginate(10);
        ($cats=Category::all())->each(function ($e) use (&$cat_sales) {
            $cat_sales[$e->id] = [
                'earning' => ($e=ProductBuy::whereHas('product', fn ($q) =>$q->where('category_id', $e->id))->orderBy('website_share', 'desc'))->avg('website_share'),
                'profile' => $e->avg('price') - $e->avg('website_share')
            ];
        });

        // $data = ProductBuy::select('website_share','created_at')->get()->groupBy(function($data){
        //     return Carbon::parse($data->created_at)->format('M');
        // });
        // $months=[];
        // $monthCount=[];
        // foreach($data as $month=>$values){
        //     $months[] =$month;
        //     $monthCount[] = count($values);
        //     // dd($month,$values);
        // }
        // dd($months,$monthCount);

        $data = ProductBuy::select(DB::raw('DATE_FORMAT(product_buys.created_at, "%Y-%m-%d") AS created_at, Sum(product_buys.`website_share`) AS website_share'))
        ->orderByRaw('created_at ASC')
        ->groupBy(DB::raw('DATE_FORMAT(product_buys.created_at, "%m")'))
        ->get();

        $months = [];
        $profits = [];
        foreach($data as $values){
            $months[] = Carbon::parse($values->created_at)->format('M/Y');
            $profits[] = $values->website_share;
        }
        // dd($months,$profits);

        return response()->view('admin.finincial.index',compact('sales','cats','cat_sales','months','profits'));
    }

}
