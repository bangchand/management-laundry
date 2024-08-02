<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'customer_id' => ['required'],
            'service_id' => ['required'],
            'total_amount' => ['required'],
            'status' => ['required'],
        ];
    }

    public function message()
    {
        return [
            'customer_id.required' => 'Field Customer is required!',
            'service_id.required' => 'Field Service is required!',
            'total_amount.required' => 'Field Amount is required!'
        ];
    }
}
