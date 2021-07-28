<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'price'=>'required',
            'category'=>'required',
            'images'=>'required',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
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
            'images.required' => 'Please upload your product photo',
            // 'images.mimes' => 'Please choose only image type(jpg,png,jpeg,gif,svg)',
            'phone.required' => 'Please describe your contact number',
            'phone.regex' => 'Please enter real phone number',
            'phone.min' => 'Please enter real phone number',
            'address.required' => 'Please describe your product location',
        ];
    }
}
