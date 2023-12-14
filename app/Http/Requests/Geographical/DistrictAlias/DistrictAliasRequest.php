<?php

namespace App\Http\Requests\geographical\DistrictAlias;

use Illuminate\Foundation\Http\FormRequest;

class DistrictAliasRequest extends FormRequest
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
            'Alias' => 'required',
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
            'Name.min' => 'You must have to enter at least 5 letters.',
            'Name.max' => 'Please enter maximun 100 letters only.',
            'StateCode.required' => 'Please enter StateCode.',
            'DistrictCode.required' => 'Please enter DistrictCode.',
            'Alias.required' => 'Please enter Alias name.',
        ];
    }
}
