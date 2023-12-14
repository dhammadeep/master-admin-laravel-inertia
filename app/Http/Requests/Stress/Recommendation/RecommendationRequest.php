<?php

namespace App\Http\Requests\Stress\Recommendation;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RecommendationRequest extends FormRequest
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
            'Name' => [
                'required',
                Rule::unique('agri_recommendation')
                ->ignore($this->recommendation,'ID')
            ]
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
            'Name.required' => 'Please enter name.',
            'Name.unique' => 'Please enter unique recommebdation.',
        ];
    }
}
