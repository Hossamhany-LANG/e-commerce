<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class InformationRequest extends FormRequest
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
            'pagename' => 'required|max:100',
            'phone' => 'required|max:100|unique:about_us,phone',
            'email' => 'required|max:150|email|unique:about_us,email',
            'image' => 'required|mimes:jpg,jpeg,png',
            'address' => 'required',
        ];
    }
}
