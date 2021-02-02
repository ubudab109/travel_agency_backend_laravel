<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationMediaRequest extends FormRequest
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
            'images_destination.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
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
            'images_destination.mimes' => 'Image format must JPEG, PNG, JPG',
            'images_destination.max' => 'Image size should not be exceeded 2MB'
        ];
    }
}
