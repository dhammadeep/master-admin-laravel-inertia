<?php

namespace App\Http\Requests\Yields\QualityChart;

use Illuminate\Foundation\Http\FormRequest;

class QualityChartRequest extends FormRequest
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
            'Name' => 'required|min:5|max:100',
            'CommodityID' => 'required',
            'PhenophaseID' => 'required',
            'HealthParameterID' => 'required',
            'GradeI' => 'required',
            'GradeII' => 'required',
            'GradeIII' => 'required',
            'MinGradeI' => 'required',
            'MaxGradeI' => 'required',
            'MinGradeII' => 'required',
            'MaxGradeII' => 'required',
            'MinGradeIII' => 'required',
            'MaxGradeIII' => 'required',
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
            'Name.min' => 'You must have to enter at least 5 letters.',
            'Name.max' => 'Please enter maximun 100 letters only.',
            'CommodityID.required' => 'Please select commodity.',
            'PhenophaseID.required' => 'Please select phenophase.',
            'HealthParameterID.required' => 'Please select healthParameter.',
            'GradeI.required' => 'Please enter GradeI.',
            'GradeII.required' => 'Please enter GradeII.',
            'GradeIII.required' => 'Please enter GradeIII.',
            'MinGradeI.required' => 'Please enter MinGradeI.',
            'MaxGradeI.required' => 'Please enter MaxGradeI.',
            'MinGradeII.required' => 'Please enter MinGradeII.',
            'MaxGradeII.required' => 'Please enter MaxGradeII.',
            'MinGradeIII.required' => 'Please enter MinGradeIII.',
            'MaxGradeIII.required' => 'Please enter MaxGradeIII.',
        ];
    }
}
