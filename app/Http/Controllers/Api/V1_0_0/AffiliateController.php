<?php
namespace App\Http\Controllers\Api\V1_0_0;
use App\Models\Affiliate;
use App\Models\ProductBuy;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\APIHelper;

class AffiliateController extends Controller
{

    public function index(Request $request)
{
    $userId = request()->user('api')->id;
    $affilliatStatus = request()->user('api')->settings->affiliate_links;

    // My Affiliate links
    
    // // Retrieve the Affiliate records based on affiliator_id
    //     $myLinks = Affiliate::where('affiliator_id', $userId)->get();

    //     // Retrieve ProductBuy records for the given affiliate tracking codes
    //     $productBuys = ProductBuy::whereIn('affiliate_code', $myLinks->pluck('tracking_code'))->get();

    //     // Get the affiliate codes for faster access
    //     $affiliateCodes = $myLinks->pluck('tracking_code');

    //     // Group productBuys by affiliate code
    //     $groupedProductBuys = $productBuys->groupBy('affiliate_code');

    //     // Prepare the final data
    //     $result = [];

    //     foreach ($myLinks as $link) {
    //         $affiliateCode = $link->tracking_code;
    //         $products = $groupedProductBuys->get($affiliateCode, collect());

    //         $boughtCount = $products->count();
    //         $share = $products->sum('affiliate_share');

    //         $product = Product::find($products->pluck('product_id')->first()); // Assuming you have a 'product_id' field in ProductBuy
    //         $productName = $product ? $product->name : 'N/A';

    //         $result[] = [
    //             'product_name' => $productName,
    //             'affiliate_link' => $link->tracking_url, // Adjust the field name as per your model
    //             'bought_count' => $boughtCount,
    //             'share' => $share,
    //         ];
    //     }
    // Retrieve the Affiliate records based on affiliator_id
        $myLinks = Affiliate::where('affiliator_id', $userId)->get();

        // Retrieve ProductBuy records for the given affiliate tracking codes
        $productBuys = ProductBuy::whereIn('affiliate_code', $myLinks->pluck('tracking_code'))->get();

        // Get the affiliate codes for faster access
        $affiliateCodes = $myLinks->pluck('tracking_code');

        // Group productBuys by affiliate code
        $groupedProductBuys = $productBuys->groupBy('affiliate_code');

        // Prepare the final data
        $myAffiliate = [];

        foreach ($myLinks as $link) {
            $affiliateCode = $link->tracking_code;
            $products = $groupedProductBuys->get($affiliateCode, collect());

            $boughtCount = $products->count();
            $share = $products->sum('affiliate_share');

            // Get the product name from the Affiliate model
            $productName = $link->product->name; // Adjust the field name as per your model

            $myAffiliate[] = [
                'product_name' => $productName,
                'affiliate_link' => $link->tracking_url, // Adjust the field name as per your model
                'bought_count' => $boughtCount,
                'share' => $share,
            ];
        }



    
    // Get the affiliate information with the related products
    $affiliateInfo = ProductBuy::whereNotNull('affiliate_code')->where('user_id', $userId)->with('product')->get();
    
    // Get all product IDs from the $affiliateInfo collection
    $productIds = $affiliateInfo->pluck('product_id')->unique()->toArray();
    
    // Create an associative array to store the product counts
    $productCounts = [];
    
    // Loop through each product ID and get the count from the ProductBuy table
    foreach ($productIds as $productId) {
        $productCount = ProductBuy::where('product_id', $productId)->whereNotNull('affiliate_code');
        $earnings = $productCount->sum('affiliate_share');
        $productCounts[$productId] = $productCount->count();
    }
    // Combine the product counts with the $affiliateInfo collection
    $affiliateInfoWithCounts = $affiliateInfo->unique('product_id')->map(function ($affiliate) use ($productCounts) {
        $productId = $affiliate->product->id;
        $productCount = $productCounts[$productId] ?? 0;
        $affiliate->product_count = $productCount;
        return $affiliate;
    });

    $earnings = $productBuys->sum('affiliate_share');
    // $earnings = $affiliateInfo->sum('affiliate_share');

    return APIHelper::jsonRender('', [$affilliatStatus, $affiliateInfoWithCounts, $earnings, $myAffiliate ]);
}


    public function toggleAffiliateLinks()
    {
        $user = request()->user('api');
        $affiliateStatus = $user->settings->affiliate_links;

        $user->settings()->update(['affiliate_links' => !$affiliateStatus]);
        return response()->json([
            'message' => 'Affiliate links switched successfully',
        ]);
    }

    public function save (Request $request ) 
    {
        $affiliate = Affiliate::create([
            'affiliator_id' => $request->affiliator_id,
            'owner_id' => $request->owner_id,
            'product_id' => $request->product_id,
            'tracking_code' => $request->tracking_code,
            'tracking_url' => $request->tracking_url
        ]);
        return response()->json(['message' => 'Affiliate saved successfully']);

    }
    
}
