<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:150'],
            'address' => ['required', 'string', 'max:150'],
            'lead_type' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:50'],
            'in_progress' => ['nullable', 'integer'],
            'last_service' => ['nullable', 'date'],
            'user_id' => ['nullable', 'integer'],
            'is_free' => ['nullable', 'integer'],
            'date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
