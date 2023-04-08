<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_uuid' => 'required|exists:users,uuid',
            'order_status_uuid' => 'required|exists:order_status,uuid',
            'payment_uuid' => 'required|exists:payments,uuid',
            'products' => 'required|array',
            'address' => 'required|json'

        ];
    }

    public function messages(): array
    {
        return [
            'user_uuid.exists' => 'User does not exist',
            'order_status_uuid.exists' => 'Order status does not exist',
            'payment_uuid.exists' => 'Payment does not exist',
        ];
    }

}
