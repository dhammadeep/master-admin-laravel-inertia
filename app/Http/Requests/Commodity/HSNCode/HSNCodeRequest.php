<?php

namespace App\Http\Requests\Commodity\HSNCode;

use Illuminate\Foundation\Http\FormRequest;

class HSNCodeRequest extends FormRequest
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
            'GeneralCommodityID' => 'required',
            'CommodityClassID' => 'required',
            'HSCode' => 'required',
            'UomID' => 'required',
            'Description' => 'required',
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
            'GeneralCommodityID.required' => 'Please Select GeneralCommodity.',
            'CommodityClassID.required' => 'Please Select Commodity Class.',
            'HSCode.required' => 'HSN Code is required.',
            'UomID.required' => 'Please Select Uom.',
            'Description.required' => 'Please enter Description.',
        ];
    }
}
