<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
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
            'name'=>'required',
            'price'=>['required',
                function ($attribute, $value, $fail) {
                    if ($value < 100) {
                        $fail ('The '.$attribute.' should be at least 100 mmk');
                    }
                },
            ],
            'category'=>'required',
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:10','max:15','ends_with:0,1,2,3,4,5,6,7,8,9',
                function ($attribute, $value, $fail) {
                    if (Str::substrCount($value, '-',) > 1) {
                        $fail ('The '.$attribute.' number must contain only one special character');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (Str::substrCount($value, '+',) > 1) {
                        $fail ('The '.$attribute.' number must contain only one special character');
                    }
                },
            ],
            'address'=>'required',
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'price.required' => 'Please describe your selling price',
            'phone.required' => 'Please describe your contact number',
            'phone.regex' => 'Please enter real phone number',
            'phone.ends_with' => 'Please enter real phone number',
            'phone.min' => 'Please enter real phone number',
            'address.required' => 'Please describe your product location',
        ];
    }
}
