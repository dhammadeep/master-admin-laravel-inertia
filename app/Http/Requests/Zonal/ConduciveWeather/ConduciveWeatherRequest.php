<?php

namespace App\Http\Requests\Zonal\ConduciveWeather;

use Illuminate\Foundation\Http\FormRequest;

class ConduciveWeatherRequest extends FormRequest
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
            'StressID' => 'required',
            'WeatherParameterID' => 'required',
            'Lower' => 'required',
            'Upper' => 'required',
            'ConduciveDuration' => 'required',
            'RelaxingDuration' => 'required',
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
            'ZonalCommodityID.required' => 'Please enter ZonalCommodity.',
            'StressID.required' => 'Please enter Stress.',
            'WeatherParameterID.required' => 'Please enter WeatherParameter.',
            'Lower.required' => 'Please enter Lower Value.',
            'Upper.required' => 'Please enter Upper Value.',
            'ConduciveDuration.required' => 'Please enter ConduciveDuration.',
            'RelaxingDuration.required' => 'Please enter RelaxingDuration.',
        ];
    }
}
