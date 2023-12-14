<?php

namespace App\Http\Requests\Zonal\Fertilizer;

use Illuminate\Foundation\Http\FormRequest;

class FertilizerRequest extends FormRequest
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
            'ZonalCommodityID' => 'required',
            'DoseFactorID' => 'required',
            'Name' => 'required',
            'UomID' => 'required',
            'Dose' => 'required',
            'Note' => 'required',
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
            'ZonalCommodityID.required' => 'Please select zonal commodity.',
            'DoseFactorID.required' => 'Please select dose factor.',
            'UomID.required' => 'Please select uom.',
            'Name.required' => 'Please select fertilizer name.',
            'Dose.required' => 'Please enter name.',
            'Note.required' => 'Please enter name.',
        ];
    }
}
