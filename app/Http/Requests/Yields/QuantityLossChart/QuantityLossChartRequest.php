<?php

namespace App\Http\Requests\Yields\QuantityLossChart;

use Illuminate\Foundation\Http\FormRequest;

class QuantityLossChartRequest extends FormRequest
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
            'PhenophaseID' => 'required',
            'StressID' => 'required',
            'MinBandValue' => 'required',
            'MaxBandValue' => 'required',
            'MinQuantityCorrectionPercent' => 'required',
            'MinQuantityCorrectionPercent' => 'required',
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
            'StressID.required' => 'Please select stress.',
            'PhenophaseID.required' => 'Please select phenophase.',
            'MinBandValue.required' => 'Please enter MinBandValue.',
            'MaxBandValue.required' => 'Please select MaxBandValue.',
            'MinQuantityCorrectionPercent.required' => 'Please select MinQuantityCorrectionPercent.',
            'MaxQuantityCorrectionPercent.required' => 'Please select MaxQuantityCorrectionPercent.',
        ];
    }
}
