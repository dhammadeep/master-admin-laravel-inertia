<?php

namespace App\Http\Requests\Commodity\Variety;

use Illuminate\Foundation\Http\FormRequest;

class VarietyRequest extends FormRequest
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
            'VarietyCode' => 'required',
            'CommodityID' => 'required',
            'HsCodeID' => 'required',
            'DomesticRestrictions' => 'required',
            'InternationalRestrictions' => 'required'
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
            'CommodityID.required' => 'Please Select Commodity.',
            'HsCodeID.required' => 'Please Select HSN Code.',
            'DomesticRestrictions.required' => 'Please Select Domestic Restrictions.',
            'InternationalRestrictions.required' => 'Please Select International Restrictions.'
        ];
    }
}
