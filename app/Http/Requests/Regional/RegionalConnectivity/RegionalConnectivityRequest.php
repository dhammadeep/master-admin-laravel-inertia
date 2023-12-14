<?php

namespace App\Http\Requests\Regional\RegionalConnectivity;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegionalConnectivityRequest extends FormRequest
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
            'RegionID' => ['required', Rule::unique('regional_connectivity_time')->ignore($this->regional_connectivity,'ID')],
            'UnsurfacedProportion' => 'required',
            'SurfacedTimeMinPerkm' => 'required',
            'UnsurfacedTimeMinPerKm' => 'required',
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
            'StateCode.required' => 'Please select State.',
            'RegionID.required' => 'Please select Region.',
            'RegionID.unique' => 'Regional-Connectivity Already Exist with : This Region',
            'SurfacedProportion.required' => 'Please enter Surfaced Proportion.',
            'UnsurfacedProportion.required' => 'Please enter Unsurfaced Proportion.',
            'SurfacedTimeMinPerkm.required' => 'Please enter Surfaced TimeMin Perkm.',
            'UnsurfacedTimeMinPerKm.required' => 'Please enter Unsurfaced TimeMin Perkm.',
            'SurfacedProportion.decimal' => 'Please enter proper decimal value (10,10) for Surfaced Proportion.',
            'UnsurfacedProportion.decimal' => 'Please enter proper decimal value (10,10) Unsurfaced Proportion.',
            'SurfacedTimeMinPerkm.decimal' => 'Please enter proper decimal value (10,6) Surfaced TimeMin Perkm.',
            'UnsurfacedTimeMinPerKm.decimal' => 'Please enter proper decimal value (10,6) Unsurfaced TimeMin Perkm.',
        ];
    }
}
