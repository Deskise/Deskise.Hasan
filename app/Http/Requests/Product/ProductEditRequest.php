<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\traits\APIRequest;
use App\Rules\FileOrUrl;
use App\Models\Category;
use App\Models\Package;
use App\Models\SocialMediaLink;
use App\Models\Subcategory;
use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'name'  =>  'required|string|max:30',
            'description'   =>  'required|string|min:250',
            'summary'   =>  'required|string|max:350',
            'price'     =>  'required|numeric',
            'img'       =>  ['required', new FileOrUrl()],
            // 'img'       =>  'required|string|max:30',
            'category'  =>  (($this->route()->getName()==='add')?'required|':'').'integer|exists:'.(new Category())->getTable().',id',
            'lifetime'  =>  'required|boolean',
            'until'     =>  'required|date_format:d/m/Y',
            'assets'    =>  'required|json',
            'subcategory'=> 'required|integer|exists:'.(new Subcategory())->getTable().',id',
            'data'      =>  'required|json',
            'packages'  =>  'required|json',
            'packages.*'  =>  'required|integer|exists:'.(new Package())->getTable().',id',
            'social_media'  =>  'required|json',
            'social_media.*'  =>  'required|json',
            'social_media.*.id'    =>  'required|integer|exists:'.(new SocialMediaLink())->getTable().',id',
            'social_media.*.link'         =>  'required|url',
            // 'file'  =>  'required|file|mimes:png,jpg,jpeg,webp,svg'
        ];
    }

    public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }
}
