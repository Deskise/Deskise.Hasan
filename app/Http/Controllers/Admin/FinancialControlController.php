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
        # code...
        $isSaved = DB::table('settings')->where("settings.key", '=',  'profit_rate')->update(['settings.value'=> $request->input('profitRate')]);

        if ($isSaved){
            \Session::flash("msg","Profit Rate Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();

    }


    function updateTaxRate(Request $request,Setting $setting)
    {
        # code...
        $isSaved = DB::table('settings')->where("settings.key", '=',  'tax_rate')->update(['settings.value'=> $request->input('taxRate')]);

        if ($isSaved){
            \Session::flash("msg","Tax Rate Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();

    }

    function updateBankCommission(Request $request,Setting $setting)
    {
        # code...
        $isSaved = DB::table('settings')->where("settings.key", '=',  'bank_commission')->update(['settings.value'=> $request->input('bankCommission')]);

        if ($isSaved){
            \Session::flash("msg","Bank Commission Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();

    }

        function updateWithdrawLimits(Request $request,Setting $setting)
    {
        # code...
        $isSaved = DB::table('settings')->where("settings.key", '=',  'withdraw_limits')->update(['settings.value'=> $request->input('withdrawLimit')]);

        if ($isSaved){
            \Session::flash("msg","Withdraw Limits Updated successfully");
            return redirect()->route('admin.financialControl.index');
        }
        return redirect()->back();

    }


}
