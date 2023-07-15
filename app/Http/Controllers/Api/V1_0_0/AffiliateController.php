<?php
namespace App\Http\Controllers\Api\V1_0_0;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\APIHelper;

class AffiliateController extends Controller
{
    public function index(Request $request) {
        // $affilliatStatus = request()->user('api')->settings->select('affiliate_links')->get();
        $affilliatStatus = request()->user('api')->settings->affiliate_links;
        return APIHelper::jsonRender('', $affilliatStatus);
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
