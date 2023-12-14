<?php

namespace App\Http\Requests\Agrochemicals\AgroCommoditychemical;

use Illuminate\Foundation\Http\FormRequest;

class AgroCommoditychemicalRequest extends FormRequest
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
            'AgrochemicalTypeID' => 'required',
            'AgrochemicalID' => 'required',
            'CIBRCApproved' => 'required',
            'WaitingPeriod' => 'required',
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
            'CommodityID.required' => 'Please select Commodity.',
            'AgrochemicalTypeID.required' => 'Please select Agrochemical Type.',
            'AgrochemicalID.required' => 'Please select Agrochemical.',
            'CIBRCApproved.required' => 'Please select CIBRCApproved.',
            'WaitingPeriod.required' => 'Please enter WaitingPeriod.',
        ];
    }
}
