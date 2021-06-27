<?php

namespace App\Http\Requests;


use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
{
    /**
     * 
     *  changing validation msg response  so i can use in react response
     * 
     */

    protected function failedValidation(Validator $validator) { 

        throw new HttpResponseException(
         
          response()->json([
            'status' => false,
            'messages' => $validator->errors()->all(),
            'type' => 'validation_error',
          ], 200)
        
        ); 
    }

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
            'billing_email'=>'required',
            'billing_phone'=>'required',
            'billing_add1'=>'required',
            'billing_country'=>'required',
            'billing_city'=>'required',
            'billing_state'=>'required',
            'billing_zipcode'=>'required',
            'payment_method'=>'required',
        ];
    }
}
