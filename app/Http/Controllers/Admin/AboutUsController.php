<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\TermsOfUse;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function about_us(){
        $about_us = AboutUs::query()->first();
        return view('admin.AboutUs.about_us',compact('about_us'));
    }

    public function about_us_update(){
        AboutUs::query()->first()->update(request()->all());
        \Session::flash("msg","added successfully");
        return redirect('admin/about_us');
    }

    public function term_of_use(){
        $terms = TermsOfUse::query()->where('term','terms')->first();
        return view('admin.terms.terms',compact('terms'));
    }

    public function term_of_use_update(){
//        dd(\request()->all());
        TermsOfUse::query()->where('term','=','terms')->first()->update(request()->all());
        \Session::flash("msg","added successfully");
        return redirect('admin/terms');
    }

    public function privacy_policy(){
        $privacy = TermsOfUse::query()->where('term','privacy')->first();
        return view('admin.privacy.privacy',compact('privacy'));
    }

    public function privacy_policy_update(){
        TermsOfUse::query()->where('term','privacy')->first()->update(request()->all());
        \Session::flash("msg","added successfully");
        return redirect('admin/privacy');
    }
}
