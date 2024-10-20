<?php

namespace App\Http\Controllers\Api\V1_0_0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\APIHelper;

class MainController extends Controller
{
    public function upload(Request $request)
    {
        if (($validator=\Validator::make($request->all(), [
            'file'  =>  'required|file|mimes:png,jpg,jpeg,webp,svg'
        ]))->fails())
            return APIHelper::jsonRender('There Was An Error Validating Your Request', $validator->errors(), 400);

        $file=new \stdClass();
        $request->file('file')?->storeAs('products/'.$request->user('api')->id,
            $file->name=time().'_#'.$request->user('api')->id.'_'.\Str::random(10).'.'.$request->file('file')?->getClientOriginalExtension(),
            'public');
        return APIHelper::jsonRender('Uploaded Successfully', $file);

    }
}
