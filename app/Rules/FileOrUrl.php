<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Support\Facades\File;

class FileOrUrl implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        return request()->hasFile($attribute) || filter_var($value, FILTER_VALIDATE_URL);
        // Check if the value is a valid URL
        // if (filter_var($value, FILTER_VALIDATE_URL)) {
        //     return true;
        // }

        // // Check if the value is a valid file
        // if (is_string($value) && File::exists(public_path($value))) {
        //     return true;
        // }

        // return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be file or url';
    }
}
