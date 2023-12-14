<?php

namespace App\Http\Requests\Agriculture\MeteorologicalWeek;

use Illuminate\Foundation\Http\FormRequest;

class MeteorologicalWeekRequest extends FormRequest
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
            'WeekNo' => 'required',
            'StartDay' => 'required',
            'StartMonth' => 'required',
            'EndDay' => 'required',
            'EndMonth' => 'required',
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
            'WeekNo.required' => 'Please enter week no.',
            'StartDay.required' => 'Please enter start day.',
            'StartMonth.required' => 'Please enter start month.',
            'EndDay.required' => 'Please enter end day.',
            'EndMonth.required' => 'Please enter end month.',

        ];
    }
}
