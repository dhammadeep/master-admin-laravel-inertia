<?php

namespace App\Http\Requests\Phenophase\CommodityPhenophase;

use Illuminate\Foundation\Http\FormRequest;

class CommodityPhenophaseRequest extends FormRequest
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
            'CommodityID.required' => 'Please enter name.',
            'PhenophaseID.required' => 'Please enter name.',
        ];
    }
}
