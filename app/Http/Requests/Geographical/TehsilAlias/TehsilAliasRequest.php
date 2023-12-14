<?php

namespace App\Http\Requests\Geographical\TehsilAlias;

use Illuminate\Foundation\Http\FormRequest;

class TehsilAliasRequest extends FormRequest
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
            'StateCode' => 'required',
            'DistrictCode' => 'required',
            'Alias' => 'required|min:5|max:100',
            'TehsilCode' => 'required',
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
            'StateCode.required' => 'Please enter state.',
            'DistrictCode.required' => 'Please enter district.',
            'Alias.required' => 'Please enter Alias.',
            'Name.min' => 'You must have to enter at least 5 letters.',
            'Name.max' => 'Please enter maximun 100 letters only.',
            'TehsilCode.required' => 'Please enter TehsilCode.',
            
        ];
    }
}
