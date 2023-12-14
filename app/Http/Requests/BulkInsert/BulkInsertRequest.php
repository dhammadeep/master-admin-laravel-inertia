<?php

namespace App\Http\Requests\BulkInsert;

use App\Rules\Filename;
use Illuminate\Foundation\Http\FormRequest;

class BulkInsertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', new Filename($this->table)]
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
            'name.required' => 'Please select file.',
            'name.mimes' => 'The file type must be: xlsx.',
        ];
    }
}
