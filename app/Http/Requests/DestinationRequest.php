<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
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
            'destination_name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'maps_url' => 'nullable',
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
            'destination_name.required' => 'Destination name is required',
            'price.required' => 'Price required',
            'price.number' => 'Price must be a number',
            'description.required' => 'Description required',
            // 'service_id.required' => 'Service required',
            // 'destination_image.mimes' => 'Image format must JPEG, PNG, JPG',
            // 'destination_image.max' => 'Image size should not be exceeded 2MB'
        ];
    }
}
