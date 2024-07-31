<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', Rule::unique('customers', 'email')->ignore($this->route('customer'))],
            'phone' => ['required', 'string', Rule::unique('customers', 'phone')->ignore($this->route('customer'))],
            'address' => ['nullable', 'string', 'max:100'],
        ];
    }
}
