<?php

namespace App\Http\Requests\Zonal\CommodityCultivationCost;

use Illuminate\Foundation\Http\FormRequest;

class CommodityCultivationCostRequest extends FormRequest
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
            'ZonalCommodityID' => 'required',
            'CostOfCultivation' => 'required',
            'CostOfProduction' => 'required',
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
            'ZonalCommodityID.required' => 'Please enter zonal commodity.',
            'CostOfCultivation.required' => 'Please enter Cost Of Cultivation.',
            'CostOfProduction.required' => 'Please enter Cost Of Production.',
        ];
    }
}
