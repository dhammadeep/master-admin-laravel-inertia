<?php

namespace App\Http\Requests\Farmer\FarmerInsuranceCompany;

use Illuminate\Foundation\Http\FormRequest;

class FarmerInsuranceCompanyRequest extends FormRequest
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
            'InsuranceTypeID' => 'required',
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
            'Name.required' => 'Insurance Company is required.',
            'InsuranceTypeID.required' => 'Please Select Insurance Type',
        ];
    }
}
