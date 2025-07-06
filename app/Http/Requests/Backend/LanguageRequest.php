<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'abbr' => 'required|string|max:10',
            'direction' => 'required|in:rtl,ltr',
            'active' => 'required|in:0,1',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'this field is required',
            'in' => 'the inputs values is incorrect',
            'string' => 'this field must be letters',
            'name.max' => 'language name must not exceed 100 letters',
            'abbr.max' => 'language abbreviation must not exceed 10 letters',
        ];
    }
}
