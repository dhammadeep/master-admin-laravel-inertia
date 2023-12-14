<?php

namespace App\Http\Requests\Stress\StressStage;

use Illuminate\Foundation\Http\FormRequest;

class StressStageRequest extends FormRequest
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
            'StressID' => 'required',
            'StageID' => 'required',
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
            'StressID.required' => 'Please select stress.',
            'StageID.required' => 'Please select stage.',
        ];
    }
}
