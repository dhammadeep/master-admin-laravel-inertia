<?php

namespace App\Http\Requests\Zonal\PhenophaseDuration;

use Illuminate\Foundation\Http\FormRequest;

class PhenophaseDurationRequest extends FormRequest
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
            'StateCode'=> 'required',
            'AczID'=> 'required',
            'ZonalCommodityID'=> 'required',
            'ZonalVarietyID'=> 'required',
            'PhenophaseID'=> 'required',
            'StartDas'=> 'numeric|required',
            'EndDas'=> 'numeric|required',
            'PhenophaseOrder'=> 'numeric|required',
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
            'AczID.required' => 'Please select ACZ.',
            'ZonalCommodityID.required' => 'Please select zonal commodity.',
            'ZonalVarietyID.required' => 'Please select zonal variety.',
            'PhenophaseID.required' => 'Please select phenophase.',
            'StartDas.required' => 'Please enter start DAS.',
            'EndDas.required' => 'Please enter End DAS.',
            'PhenophaseOrder.required' => 'Please enter phenophase order.',
        ];
    }
}
