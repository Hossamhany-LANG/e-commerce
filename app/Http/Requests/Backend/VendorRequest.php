<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
        $id = $this->id ?? null;

        return [
            'name' => 'required|max:150|string',
            'category_id' => 'required',
            'phone' => 'required|max:100|unique:vendors,phone,' . $id,
            'email' => 'required|email|max:150|unique:vendors,email,' . $id,
            'active' => 'required|in:0,1',
            'logo' => 'required_without:id|mimes:jpg,jpeg,png',
            'password' => 'nullable|min:8'
        ];
    }

}
