<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
            'title' => 'bail|required|max:255|unique:posts,id,'.$this->id,
            'slug' => 'bail|required|unique:posts,id,'.$this->id,
            'content' => 'required',
            'metadata' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.unique' => 'Title should be unique',
            'slug.required' => 'Slug is required',
            'slug.unique' => 'Slug should be unique',
            'content.required' => 'Content is required',
            'metadata.required' => 'Post metadata is required'
        ];
    }

}
