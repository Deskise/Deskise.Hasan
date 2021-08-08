<?php

namespace App\Http\Requests;

use App\Http\Requests\traits\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'  =>  'required|string',
            'email' =>  'required|email',
            'message'=> 'required|string|max:350'
        ];
    }

    public function messages()
    {
        return __('api/data.errors.requests.messages.contact');
    }
}
