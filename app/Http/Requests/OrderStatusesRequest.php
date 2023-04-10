<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStatusesRequest extends FormRequest
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
            'title' => 'bail|required|unique:order_statuses,id,'.$this->id,
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.unique' => 'Title should be unique',
        ];
    }
}
