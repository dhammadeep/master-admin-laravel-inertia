<?php

namespace App\Http\Requests\Stress\SeedTreatment;

use Illuminate\Foundation\Http\FormRequest;

class SeedTreatmentRequest extends FormRequest
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
            'CommodityID' => 'required',
            'VarietyID' => 'required',
            'UomID' => 'required',
            'Name' => 'required',
            'Dose' => 'required|numeric',
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
            'CommodityID.required' => 'Please select commodity.',
            'VarietyID.required' => 'Please select variety.',
            'UomID.required' => 'Please select uom.',
            'Name.required' => 'Please enter name.',
            'Dose.required' => 'Please enter dose.',
            'Dose.numeric' => 'Please enter numeric value.',
        ];
    }
}
