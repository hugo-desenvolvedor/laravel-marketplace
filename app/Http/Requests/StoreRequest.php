<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required|min:10',
            'phone' => 'required',
            'mobile_phone' => 'required',
            'image' => __('The file is not an image.'),
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'required' => __('The :attribute field is required.'),
            'min' => __('The description must be at least :min characters.'),
            'image' => __('The file is not an image.'),
        ];
    }
}
