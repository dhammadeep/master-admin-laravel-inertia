<?php

namespace App\Http\Requests\Agrochemicals\AgrochemicalBrand;

use Illuminate\Foundation\Http\FormRequest;

class AgrochemicalBrandRequest extends FormRequest
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
            'AgrochemicalID' => 'required',
            'AgrochemicalTypeID' => 'required',
            'CompanyID' => 'required',
            'Name' => 'required|min:5|max:100',
            'AgrochemicalStatus' => 'required',
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
            'AgrochemicalID.required' => 'Please select Agrochemical.',
            'AgrochemicalTypeID.required' => 'Please select Agrochemical Type.',
            'CompanyID.required' => 'Please select Company.',
            'Name.required' => 'Please enter name.',
            'Name.min' => 'You must have to enter at least 5 letters.',
            'Name.max' => 'Please enter maximun 100 letters only.',
            'AgrochemicalStatus.required' => 'Please select Agrochemical Status.',
        ];
    }
}
