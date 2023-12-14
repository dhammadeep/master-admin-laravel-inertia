<?php

namespace App\Http\Requests\Zonal\FieldActivity;

use Illuminate\Foundation\Http\FormRequest;

class FieldActivityRequest extends FormRequest
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
            'PhenophaseID' => 'required',
            'Name' => 'required',
            'Description' => 'required',
            'ImageUrl' => 'required',
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
            'ZonalCommodityID.required' => 'Please enter ZonalCommodity.',
            'PhenophaseID.required' => 'Please enter Phenophase.',
            'Name.required' => 'Please enter name.',
            'Description.required' => 'Please enter Description.',
            'ImageUrl.required' => 'Please enter ImageUrl.',
        ];
    }
}
