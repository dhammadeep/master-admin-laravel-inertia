<?php

namespace App\Http\Requests\Geographical\Region;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'StateCode' => 'required',
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
            'Name.required' => 'Please enter region name.',
            'StateCode.required' => 'Please enter StateCode.',
            'Description.required' => 'Please enter Description.',
        ];
    }
}
