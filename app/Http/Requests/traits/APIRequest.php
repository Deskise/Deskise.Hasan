<?php


    namespace App\Http\Requests\traits;


    use App\Helpers\APIHelper;
    use Illuminate\Contracts\Validation\Validator;

    trait APIRequest
    {
        public $response;
        public $hasError = false;


        protected function failedValidation(Validator $validator)
        {
            $this->hasError = true;
            $this->response = APIHelper::error(__('api/data.errors.requests.notValid'), ['errors'=>$validator->errors()]);
        }
    }
