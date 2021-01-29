<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'payment_name' => 'required'
        ];
    }

    /**
     * Message if validation fails
     *
     * @return message each name field
     */
    public function messages()
    {
        return [
            'payment_name.required' => 'Payment name is required',
        ];
    }
}
