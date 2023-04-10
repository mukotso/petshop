<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,id,'.$this->id,
            'address' => 'required',
            'phone_number' => 'bail|required|numeric|min:10'
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.email' => 'Last name is required',
            'email.required' => 'Email address is required',
            'email.email' => 'Enter a valid email address e.g myemail@gmail.com',
            'address.required' => 'address is required',
            'phone_number.required' => 'Phone number  is required',
            'phone_number.numeric' => 'Phone number  should only contain numeric values',
            'phone_number.min' => 'Phone number  should have a minimum of 10 digits',
        ];
    }

}
