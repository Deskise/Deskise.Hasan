<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class FinancialControlController extends Controller
{

    public function index()
    {
        //
        $values = Setting::all();

        return response()->view('admin.financialControl.index',compact('values'));
    }


    function updateProfitRate(Request $request,Setting $setting)
    {
        $isSaved = DB::table('settings')->where("settings.key", '=',  'profit_rate')->update(['settings.value'=> $request->input('profitRate')]);

        if ($isSaved){
            \Session::flash("msg","s:Profit Rate Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();
    }

    function updateAffiliateRate(Request $request,Setting $setting)
    {
        // dd($request->input('affiliateRate'));
        $isSaved = DB::table('settings')->where("settings.key", '=',  'affiliate_rate')->update(['settings.value'=> $request->input('affiliateRate')]);

        if ($isSaved){
            \Session::flash("msg","s:Share Rate Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();
    }


    function updateTaxRate(Request $request,Setting $setting)
    {
        # code...
        $isSaved = DB::table('settings')->where("settings.key", '=',  'tax_rate')->update(['settings.value'=> $request->input('taxRate')]);

        if ($isSaved){
            \Session::flash("msg","s:Tax Rate Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();

    }

    function updateBankCommission(Request $request,Setting $setting)
    {
        # code...
        $isSaved = DB::table('settings')->where("settings.key", '=',  'bank_commission')->update(['settings.value'=> $request->input('bankCommission')]);

        if ($isSaved){
            \Session::flash("msg","s:Bank Commission Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();

    }

        function updateWithdrawLimits(Request $request,Setting $setting)
    {
        # code...
        $isSaved = DB::table('settings')->where("settings.key", '=',  'withdraw_limits')->update(['settings.value'=> $request->input('withdrawLimit')]);

        if ($isSaved){
            \Session::flash("msg","s:Withdraw Limits Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();

    }


}
