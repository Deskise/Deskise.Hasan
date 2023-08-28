<?php

namespace App\Http\Controllers\Api\V1_0_0;

use App\Http\Controllers\Admin\financialcontrolController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductBuy;
use App\Models\Chat;
use App\Models\Product;
use App\Models\User;
use App\Models\Affiliate;
use App\Models\Setting;
use App\Models\WithdrawRequest;
use App\Helpers\APIHelper;
use Illuminate\Support\Facades\DB;

use Stripe\Stripe;
use Stripe\Account;

class PaymentController extends Controller
{

    public function getWithdrawLimit() 
    {
       $withdrawLimit = DB::table('settings')
        ->where('key', 'withdraw_limits')
        ->select('value')
        ->first();

        return $withdrawLimit->value;

    }

    public function createConnectedAccount(Request $request)
    {
        $withdrawLimit = DB::table('settings')
        ->where('key', 'withdraw_limits')
        ->select('value')
        ->first();
        $limitValue = $withdrawLimit->value;

        $userId = request()->user('api')->id;
        $user = request()->user('api');
        $existAccount = WithdrawRequest::where('user_id', $userId)->first();
        $requestAmount = $request->amount;
        if ($existAccount) {
            if($limitValue >= $requestAmount) {
                $withdrawRequest = new WithdrawRequest();
                $withdrawRequest->user()->associate($user);
                $withdrawRequest->fill([
                    'stripe_acc' => $existAccount->stripe_acc,
                    'amount' => $requestAmount,
                    'status' => 'pending'
                ])->save();
                $res = '0';
                
            } else {
                $res = 'x';
            }
            return $res;

        };

        if (!$existAccount) {
        // Initialize Stripe with your secret API key
        Stripe::setApiKey(config('services.stripe.secret_key')); // Replace with your Stripe secret API key

        // Data collected from the vendor's sign-up or registration form
        $vendorData = [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->userEmail,
        ];

        // Create the Express Account
        try {
            $account = Account::create([
                'type' => 'express',
                'email' => $vendorData['email'],
                'business_type' => 'individual',
                'business_profile' => [
                    'product_description' => 'this is the product description for this seller...'
                ],
                'individual' => [
                    'first_name' => $vendorData['first_name'],
                    'last_name' => $vendorData['last_name'],
                ],
            ]);
        
            // The $account object now contains the vendor's Express Account details
            $accountId = $account->id;
            // You can store $accountId in your database for future reference
            
            // Redirect the vendor to the Stripe onboarding link to complete their account setup
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
            $accountLink = $stripe->accountLinks->create(
                ['account' => $accountId,
                'refresh_url' => 'https://example.com/reauth',
                'return_url' => 'http://localhost:8080/#/dash/sales',
                'type' => 'account_onboarding',]
            );
            return $accountLink->url;

        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle errors
            echo 'Error: ' . $e->getMessage();
            // Log the error or display an error message to the user
        }
        };
        if ($accountId) {
            $totalSales = ProductBuy::where('user_id', $userId)->sum('price');
            $payouts = WithdrawRequest::where('status', 'approved')->where('user_id', $userId)->sum('amount');
            $userBalance = $totalSales - $payouts;
            if($limitValue >= $requestAmount && $requestAmount <= $userBalance) {
                $newAccount = new WithdrawRequest();
                $newAccount->user()->associate($user);
                $newAccount->fill([
                    'stripe_acc' => $account->id,
                    'amount' => $request->amount,
                    'status' => 'pending'
                ]);
            } else return APIHelper::error('The amount of the withdraw request is not Valide');
                $newAccount->save();
        } else return APIHelper::error('You have to complete your Stripe account');
    }

    public function createPaymentIntent(Request $request)
    {
        // dd($request->all());
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->create([
        'amount' => $request->price * 100,
        'currency' => 'usd',
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
        ]);

        return ['clientSecret' => $paymentIntent->client_secret,];
    }

    public function confirm(Request $request)
    {
         $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
         $paymentIntent = $stripe->paymentIntents->retrieve($request->query('payment_intent'), []);
         dd($paymentIntent);
    }

    public function createPayment(Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->product_id);
        // the user_id column in product_buys table is the ownerId
        $user = User::find($request->ownerId);
        
        if (!$product || !$user) {
            return response()->json(['error' => 'Product or User not found'], 404);
        }
        // Get the profit_rate value from the settings table
        $profitRate = Setting::where('key', 'profit_rate')->value('value');
        $profitRate = floatval($profitRate) / 100;
        $affiliateRate = Setting::where('key', 'affiliate_rate')->value('value');
        $affiliateRate = floatval($affiliateRate) / 100;
        $texRate = Setting::where('key', 'tax')->value('value');
        $texRate = floatval($texRate) / 100;
        $bankCommision = Setting::where('key', 'bank_commission')->value('value');
        $bankCommision = floatval($bankCommision) / 100;

        $affiliate = Affiliate::where('tracking_code', $request->affiliate_code)->first();
        $affiliate_code = $affiliate ? $request->affiliate_code : null;
        $affiliate_share = $affiliate ? $request->price * $affiliateRate : 0;
        $website_share = $request->price * $profitRate;
        $texCut = $request->price * $texRate;
        $bankCut = $request->price * $bankCommision;

        $sharesCut = $affiliate_share + $website_share + $texRate + $bankCommision;
        $netPrice = $request->price - $sharesCut;

        $payment = $product->bought()->create([
            'price' => $netPrice,
            'buyer_id' => $request->user_id,
            'website_share' => $website_share,
            'transaction_id' => $request->transaction_id,
            'affiliate_code' => $affiliate_code,
            'affiliate_share' => $affiliate_share,
        ]);

        // the user_id column in product_buys table is the ownerId
        $payment->user()->associate($user);

        $payment->save();

        $chat = Chat::where(function ($query) use ($request) {
            $query->where('member1', $request->user_id)
                ->where('member2', $request->ownerId);
        })->orWhere(function ($query) use ($request) {
            $query->where('member1', $request->ownerId)
                ->where('member2', $request->user_id);
        })->first();
        
        if ($chat) {
            $chat->update([
                'product_id' => $request->product_id
            ]);
            return response()->json(['chat_id' => $chat->id]);
        }

        $createChat = $user->chats()->create([
            'member1' => $request->user_id,
            'member2' => $request->ownerId,
            'product_id' => $request->product_id
        ]);
       
        return response()->json(['chat_id' => $createChat->id]);

    }

    public function userSales($id)
    {
        $userSales = ProductBuy::where('user_id', $id)->with('product')->where('user_id', $id)->get();
        // $productInfo = Product::where('user_id', $id)->get();
        $lastWithdrawRequest = WithdrawRequest::where('user_id', $id)->latest()->first();
        $payouts = WithdrawRequest::where('user_id', $id)->where('status', 'approved')->sum('amount');

        $websiteShare = $userSales->sum('website_share');
        $affiliateShare = $userSales->sum('affiliate_share');
        $totalSales = $userSales->sum('price');
        $sharesCut = $websiteShare + $affiliateShare;
        $total = $totalSales - $sharesCut;
        $userBalance = floatval($total - $payouts);

        return response()->json([
            'userSales' => $userSales,
            'total' => $total,
            'lastWithdrawRequest' => $lastWithdrawRequest,
            'userBalance' => $userBalance
        ]);
    }

    // Withdraw

    public function withdrawList()
    {
        // $withdrawList = WithdrawRequest::all()->with('user')->get();
        $withDraw = WithdrawRequest::paginate(15);
        $withdrawList = WithdrawRequest::with('user')->get();
        
        return response()->view('admin.withdrawRequests.index',compact('withdrawList','withDraw'));
    }

    public function approveWithdraw(Request $request, $id)
    {
        $withdrawRequest = WithdrawRequest::find($id);
        if ($withdrawRequest) {
        $withdrawRequest->status = 'approved';
        $withdrawRequest->save();

        return redirect()->back()->with('success', 'Withdraw request approved successfully.');
        }

        return redirect()->back()->with('error', 'Withdraw request not found.');
    }


    public function removeWithdraw(Request $request, $id)
    {
        $withdrawRequest = WithdrawRequest::find($id);
        $withdrawRequest->delete();

        return redirect()->back();
    }

    public function declineWithdraw(Request $request, $id)
    {
        $withdrawRequest = WithdrawRequest::find($id);
        if ($withdrawRequest) {
        $withdrawRequest->status = 'declined';
        $withdrawRequest->save();

        return redirect()->back()->with('success', 'Withdraw request declined successfully.');
    }

    return redirect()->back()->with('error', 'Withdraw request not found.');
    }
}
