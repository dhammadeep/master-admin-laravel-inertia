<?php

namespace App\Http\Requests\General\WeatherParams;

use Illuminate\Foundation\Http\FormRequest;

class WeatherParamsRequest extends FormRequest
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
            'Name' => 'required',
            'Label' => 'required',
            'UnitID' => 'required'
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
            'Label.required' => 'Please enter label.',
            'UnitID.required' => 'Please enter unit id.'
        ];
    }
}
