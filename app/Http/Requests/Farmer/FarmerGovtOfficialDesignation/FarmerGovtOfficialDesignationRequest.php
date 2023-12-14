<?php

namespace App\Http\Requests\Farmer\FarmerGovtOfficialDesignation;

use Illuminate\Foundation\Http\FormRequest;

class FarmerGovtOfficialDesignationRequest extends FormRequest
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
            'DepartmentID' => 'required',
            'Name' => 'required',
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
            'DepartmentID.required' => 'Please Select Department.',
            'Name.required' => 'Govt Official Designation Name is required',
        ];
    }
}
