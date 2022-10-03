<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    //

    public function CreateCategory(){

        return response()->view('admin.category.create');
    }



}
