<?php

namespace App\Http\Requests\Stress\CommodityStressStage;

use Illuminate\Foundation\Http\FormRequest;

class CommodityStressStageRequest extends FormRequest
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
            'StressID' => 'required',
            'StageID' => 'required',
            'Description' => 'required',
            'StartPhenophaseID' => 'required',
            'EndPhenophaseID' => 'required',
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
            'StageID.required' => 'Please select stage.',
            'Description.required' => 'Please enter name.',
            'StartPhenophaseID.required' => 'Please select start phenophase.',
            'EndPhenophaseID.required' => 'Please select end phenophase.',
        ];
    }
}
