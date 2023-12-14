<?php

namespace App\Http\Requests\Geographical\Tehsil;

use Illuminate\Foundation\Http\FormRequest;

class TehsilRequest extends FormRequest
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
            'Name' => 'required',
            'StateCode' => 'required',
            'DistrictCode' => 'required',
            'TehsilCode' => 'required',
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
            'Name.required' => 'Please enter name.',
            'StateCode.required' => 'Please select State Name.',
            'DistrictCode.required' => 'Please select District Name.',
            'TehsilCode.required' => 'Please enter TehsilCode.',
        ];
    }
}
