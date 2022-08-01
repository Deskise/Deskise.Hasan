<?php

namespace App\Http\Requests;

use App\Http\Requests\traits\APIRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest
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
            'firstname' => 'required|string|max:20',
            'lastname' => 'required|string|max:20',
            'email'     => 'required|string|email',
            'password'  => 'string|nullable',
            'newsletter_subscribe'  =>  'required|boolean',
            'terms'     =>  'required|boolean',
            'uuid'      =>  'string|max:30',
            'google_id' =>  'string|nullable',
            'facebook_id'=> 'string|nullable',
            'image'     =>  'url|nullable'
        ];
    }

    public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }
}