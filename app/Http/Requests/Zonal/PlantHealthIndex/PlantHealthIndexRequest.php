<?php

namespace App\Http\Requests\Zonal\PlantHealthIndex;

use Illuminate\Foundation\Http\FormRequest;

class PlantHealthIndexRequest extends FormRequest
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
            'StateCode'=> 'required',
            'AczID'=> 'required',
            'ZonalCommodityID'=> 'required',
            'ZonalVarietyID'=> 'required',
            'PhenophaseID'=> 'required',
            'HealthParameterID'=> 'required',
            'Specifications'=> 'required',
            'NormalValue'=> 'required',
            'IdealValue' => 'required'
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
            'StateCode.required' => 'Please select state.',
            'AczID.required' => 'Please select ACZ.',
            'ZonalCommodityID.required' => 'Please select zonal commodity.',
            'ZonalVarietyID.required' => 'Please select zonal variety.',
            'PhenophaseID.required' => 'Please select phenophase.',
            'HealthParameterID.required' => 'Please select health parameter.',
            'Specifications.required' => 'Please enter specifications.',
            'NormalValue.required' => 'Please enter normal value.',
            'IdealValue.required' => 'Please enter ideal value.',
        ];
    }
}
