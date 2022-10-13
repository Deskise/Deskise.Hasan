<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialControlController extends Controller
{

    public function index()
    {
        //
        return response()->view('admin.financialControl.index');
    }



    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }



}
