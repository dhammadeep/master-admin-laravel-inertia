<?php

namespace App\Http\Requests\Config\SyncConfig;

use Illuminate\Foundation\Http\FormRequest;

class SyncConfigRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ZippingLevel' => 'required|min:5|max:100',
            'Screen' => 'required|min:5|max:100',
            'Role' => 'required|min:5|max:100',
            'TableName' => 'required|min:5|max:100',
            'LabelName' => 'required|min:5|max:100',
        ];
    }

    /**
     * Get the validation error messages that apply to the request
     *
     * @return array
     */
    public function messages()
    {
        return [
            'Screen.required' => 'Please enter Screen name.',
            'Screen.min' => 'You must have to enter at least 5 letters.',
            'Screen.max' => 'Please enter maximun 100 letters only.',
        ];
    }
}
