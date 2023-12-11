<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditBrandRequest extends FormRequest
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
            'title'=>'required|unique:brand_translations,title,'.$this->id.',brand_id',
            // [
            //     'required',Rule::unique('brand_translations', 'title')->ignore($this->brand)
            // ],
            'description' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'title.unique'=>'Title Is Alredy Exists',
            'description.required' => 'Description is required!',
        ];
    }
}
