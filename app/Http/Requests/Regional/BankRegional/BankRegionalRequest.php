<?php

namespace App\Http\Requests\Regional\BankRegional;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BankRegionalRequest extends FormRequest
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
            'BankID' => [
                            'required',
                            Rule::unique('regional_bank')
                            ->where('StateCode', $this->StateCode)
                            ->where('BankID', $this->BankID)
                            ->ignore($this->bank_regional,'ID')
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
            'BankID.required' => 'Please select bank.',
            'BankID.unique' => 'Regional-Bank Already Exist with : This Bank',
        ];
    }
}
