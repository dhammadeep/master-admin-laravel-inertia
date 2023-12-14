<?php

namespace App\Http\Requests\Agriculture\BenchmarkVariety;

use Illuminate\Foundation\Http\FormRequest;

class BenchmarkVarietyRequest extends FormRequest
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
            'SeasonID' => 'required',
            'CommodityID' => 'required',
            'VarietyID' => 'required',
            'IsDrkBenchmark' => 'required',
            'IsAgmBenchmark' => 'required',
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
            'SeasonID.required' => 'Please select season.',
            'CommodityID.required' => 'Please select commodity.',
            'VarietyID.required' => 'Please select variety.',
            'IsDrkBenchmark.required' => 'Please select IsDrkBenchmark.',
            'IsAgmBenchmark.required' => 'Please select IsAgmBenchmark.',
        ];
    }
}
