<?php

namespace App\Http\Requests\Zonal\ZonalCommodity;

use Illuminate\Foundation\Http\FormRequest;

class ZonalCommodityRequest extends FormRequest
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
            'AczID' => 'required',
            'CommodityID' => 'required',
            'SowingWeekStart' => 'required',
            'SowingWeekEnd' => 'required',
            'HarvestWeekStart' => 'required',
            'HarvestWeekEnd' => 'required',
            'NoOfDaysForHarvestMonitoring' => 'required',
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
            'StateCode.required' => 'Please Select State.',
            'AczID.required' => 'Please Select ACZ.',
            'CommodityID.required' => 'Please Select Commodity.',
            'SowingWeekStart.required' => 'Please Select Sowing Week Start.',
            'SowingWeekEnd.required' => 'Please Select Sowing Week End.',
            'HarvestWeekStart.required' => 'Please Select Harvest Week Start.',
            'HarvestWeekEnd.required' => 'Please Select Harvest Week End.',
            'NoOfDaysForHarvestMonitoring.required' => 'No. of Days For Harvest Monitoring is required and it must be Numeric Only',
        ];
    }
}
