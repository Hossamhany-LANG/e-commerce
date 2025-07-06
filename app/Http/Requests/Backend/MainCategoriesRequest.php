<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoriesRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'categories' => 'required|array|min:1',
            'categories.*.name' => 'required|string|max:255',
            'categories.*.active' => 'required|boolean',

        ];
    }
    public function messages(): array
    {
        return [
            'categories.required' => 'You must add at least one category.',
            'categories.*.name.required' => 'The category name field is required.',
            'categories.*.active.required' => 'Please select active status.',
            'photo.required' => 'A photo is required.',
            'photo.mimes' => 'The photo must be a file of type: jpg, jpeg, png.',
        ];
    }
    
}
