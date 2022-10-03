<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductRequest;
use Illuminate\Http\Request;

class ProductRequestsController extends Controller
{

    public function index()
    {
        //
        $productRequests = ProductRequest::where('status','!=','approved')->paginate(15);
        return response()->view('admin.productRequests.index',compact('productRequests'));
    }



    public function approveProductRequest(Request $request,ProductRequest $productRequest)
    {
        $request->validate([
            'url'   => 'url|required'
        ]);

        $productRequest->url = $request->input('url');
        if ($productRequest->status ==='waiting' || $productRequest->status ==='rejected'){
            $productRequest -> update(['status' => 'approved']);
            return redirect()->back()->with('msg','s:Product Request Approved');
        }
        return redirect()->back()->with('msg', 'e:Product Already Approved');

    }


    public function rejectProductRequest(ProductRequest $productRequest)
    {

        if ($productRequest->status ==='waiting' || $productRequest->status ==='approved'){
            $productRequest -> update([
                'status' => 'rejected'
            ]);
            return redirect()->back()->with('msg','e:Product Request Rejected');
        }
        return redirect()->back();
    }
}
