<?php

namespace App\Http\Requests\Zonal\FavourableWeather;

use Illuminate\Foundation\Http\FormRequest;

class FavourableWeatherRequest extends FormRequest
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
            'PhenophaseID' => 'required',
            'WeatherParameterID' => 'required',
            'SpecificationAverage' => 'required',
            'SpecificationLower' => 'required',
            'SpecificationUpper' => 'required',
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
            'ZonalCommodityID.required' => 'Please select zonal commodity.',
            'PhenophaseID.required' => 'Please select zonal phenophase.',
            'WeatherParameterID.required' => 'Please select zonal weather parameter.',
            'SpecificationAverage.required' => 'Please enter specification average.',
            'SpecificationLower.required' => 'Please enter specification lower.',
            'SpecificationUpper.required' => 'Please enter specification upper.',
        ];
    }
}
