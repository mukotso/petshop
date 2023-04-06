<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'bail|required|numeric',
            'title' => 'bail|required|max:255',
            'description' => 'required',
            'metadata' => 'required',
            'price' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select category for this product',
            'title.required' => 'Title is required',
            'title.unique' => 'Title should be unique',
            'slug.required' => 'Slug is required',
            'slug.unique' => 'Slug should be unique',
            'description.required' => 'Description is required',
            'metadata.required' => 'Metadata is required',
            'price.required' => 'Description is required',
        ];
    }
}
