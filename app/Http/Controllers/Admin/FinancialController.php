<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBuy;
use App\Models\Setting;
use Illuminate\Http\Request;

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

        return response()->view('admin.finincial.index',compact('sales','cats','cat_sales'));
    }

}
