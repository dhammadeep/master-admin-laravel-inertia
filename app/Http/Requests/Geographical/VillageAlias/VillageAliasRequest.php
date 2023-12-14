<?php

namespace App\Http\Requests\Geographical\VillageAlias;

use Illuminate\Foundation\Http\FormRequest;

class VillageAliasRequest extends FormRequest
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
            'VillageCode' => 'required',
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
            'StateCode.required' => 'Please select dtate name.',
            'DistrictCode.required' => 'Please select district name.',
            'TehsilCode.required' => 'Please select tehsil name.',
            'VillageCode.required' => 'Please select village.',
            'Alias.required' => 'Please enter alias.',

        ];
    }
}
