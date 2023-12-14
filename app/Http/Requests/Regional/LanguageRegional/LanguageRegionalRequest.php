<?php

namespace App\Http\Requests\Regional\LanguageRegional;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LanguageRegionalRequest extends FormRequest
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
            'LanguageID' => [
                                'required',
                                Rule::unique('regional_language')
                                ->where('StateCode', $this->StateCode)
                                ->where('LanguageID', $this->LanguageID)
                                ->ignore($this->language_regional,'ID')
                            ],
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
            'LanguageID.required' => 'Please select language.',
            'LanguageID.unique' => 'Regional-Language Already Exist with : This Language',
        ];
    }
}
