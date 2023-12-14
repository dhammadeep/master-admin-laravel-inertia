<?php

namespace App\Http\Requests\Geographical\Panchayat;

use Illuminate\Foundation\Http\FormRequest;

class PanchayatRequest extends FormRequest
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
            'StateCode' => 'required',
            'DistrictCode' => 'required',
            'TehsilCode' => 'required',
            'PanchayatCode' => 'required',
            'Name' => 'required|min:5|max:100',
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
            'StateCode.required' => 'Please select StateCode.',
            'DistrictCode.required' => 'Please select DistrictCode.',
            'TehsilCode.required' => 'Please select TehsilCode.',
            'PanchayatCode.required' => 'Please enter PanchayatCode name.',
            'Name.required' => 'Please enter name.',
            'Name.min' => 'You must have to enter at least 5 letters.',
            'Name.max' => 'Please enter maximun 100 letters only.',
        ];
    }
}
