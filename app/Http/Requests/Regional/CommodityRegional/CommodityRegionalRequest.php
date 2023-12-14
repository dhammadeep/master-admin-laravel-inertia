<?php

namespace App\Http\Requests\Regional\CommodityRegional;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CommodityRegionalRequest extends FormRequest
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
            'RegionID' => 'required',
            'AczId' => 'required',
            'ZonalCommodityID' => [
                                        'required',
                                        Rule::unique('regional_commodity')
                                        ->where('StateCode', $this->StateCode)
                                        ->where('RegionID', $this->RegionID)
                                        ->where('ZonalCommodityID', $this->ZonalCommodityID)
                                        ->ignore($this->commodity_regional,'ID')
                                    ],
            'HarvestRelaxation' => 'required',
            'MaxRigtsInLot' => 'required',
            'MinLotSize' => 'required',
            'TargetValue' => 'required',
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
            'RegionID.required' => 'Please select region.',
            'AczId.required' => 'Please select acz commodity.',
            'ZonalCommodityID.required' => 'Please select zonal commodity.',
            'ZonalCommodityID.unique' => 'Regional-Commodity Already Exist with : This Zonal Zommodity, State and Region.',
            'HarvestRelaxation.required' => 'Please enter harvest relaxation.',
            'MaxRigtsInLot.required' => 'Please enter max rigts in lot.',
            'MinLotSize.required' => 'Please enter min lot size.',
            'TargetValue.required' => 'Please enter target value.',
        ];
    }
}
