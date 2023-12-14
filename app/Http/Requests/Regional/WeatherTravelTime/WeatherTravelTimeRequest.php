<?php

namespace App\Http\Requests\Regional\WeatherTravelTime;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WeatherTravelTimeRequest extends FormRequest
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
            'Name' => ['required', Rule::unique('weather_based_travel_time')->ignore($this->weather_travel_time,'ID')],
            'MinPerKm' => 'required',
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
            'Name.required' => 'Please enter name.',
            'Name.unique' => 'Weather Travel Time Already Exist with : This Name.',
            'MinPerKm.required' => 'Please enter Min Per Km.',
        ];
    }
}
