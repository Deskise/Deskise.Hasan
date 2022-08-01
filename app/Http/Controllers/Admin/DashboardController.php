<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Chat;
use App\Models\ChatAgreement;
use App\Models\HomeText;
use App\Models\Product;
use App\Models\ProductBuy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){
        $new_users = User::query()
            ->whereMonth('created_at',now()->format('m'))
            ->count();

        $users = User::query()->count();
        $chats = Chat::query()->count();
        $chat_agrees = ChatAgreement::query()->count();
        $ProductBuy = ProductBuy::query()->count();

        $date = \Carbon\Carbon::now();
        $months[] = Carbon::now()->month;
        $months[] =  $date->subMonth(1)->month;
        $months[] =  $date->subMonth(1)->month;
        $months[] =  $date->subMonth(1)->month;
        $months[] =  $date->subMonth(1)->month;

        foreach ($months as $month ){
            $this_month = ProductBuy::whereMonth('created_at', $month)->count();
            $values[] =$this_month ;
        }

        $values  = json_encode($values);
        $months  = json_encode($months);
        $topUsers=  Product::with('user')->withCount('bought')->orderBy('bought_count')->limit(5)->get()->pluck('user');

        foreach ($categories = Category::all() as $cat){
            $products_ids  = Product::where('category_id' , $cat->id)->pluck('id')->toArray();

            $db = DB::table('product_buys')
               ->join('products', 'products.id', '=', 'product_buys.product_id')
               ->select(DB::raw('products.* , product_id ,COUNT(*) c'))
               ->whereIn('product_id',  $products_ids)
               ->groupBy('product_id')
               ->orderBy('c' , 'desc')
              // ->raw('SELECT product_id ,COUNT(*) c  where product_id in ('. $products_ids .') GROUP BY name;')
              ->limit(3)->get();

            $cat->top_products =  $db ;
        }

        return view('dashboard.admin',compact('new_users',
            'users','chats','chat_agrees','ProductBuy' , 'values' ,'months','categories' ,'topUsers'));
    }

    public function setting(){
        $texts = HomeText::query()->get();
        return view('admin.AboutUs.setting',compact('texts'));
    }

    public function editHome($id){
        HomeText::find($id)->update([
            'value' => request('value')
        ]);
        return redirect(route('setting'));
    }
}

