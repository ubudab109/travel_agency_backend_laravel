<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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
            'service_name.required' => 'Service name is required',
            'logo.mimes' => 'Logo format must JPEG, PNG, JPG',
            'logo.max' => 'Logo size should not be exceeded 2MB'
        ];
    }
}
