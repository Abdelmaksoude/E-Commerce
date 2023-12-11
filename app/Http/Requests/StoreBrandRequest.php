<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'title' => 'required|unique:brand_translations',
            'description' => 'required',
            'photo' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'title.unique' => 'Title is exists!',
            'description.required' => 'Description is required!',
            'photo.required' => 'Photo is required!'
        ];
    }
}
