<?php

namespace App\Http\Requests;

use App\Http\Requests\traits\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    use APIRequest;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category'  =>  'required|exists:App\Models\Category,id',
            'subcategory'=> 'required|exists:App\Models\Subcategory,id',
            'price'     =>  'required|numeric',
            'message'   =>  'required|string',
            'email'     =>  'required|email',
            'sendEmails'=>  'required|in:0,1'
        ];
    }
    public function messages()
    {
        return __('api/data.errors.requests.messages.products');
    }
}
