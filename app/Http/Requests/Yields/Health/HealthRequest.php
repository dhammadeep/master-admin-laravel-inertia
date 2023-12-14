<?php

namespace App\Http\Requests\Yields\Health;

use Illuminate\Foundation\Http\FormRequest;

class HealthRequest extends FormRequest
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
            'HealthParameterID' => 'required',
            'Specification' => 'required'
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
            'PhenophaseID.required' => 'Please select phenophase.',
            'HealthParameterID.required' => 'Please select health parameter.',
            'Specification.required' => 'Please enter name specification.',

        ];
    }
}
