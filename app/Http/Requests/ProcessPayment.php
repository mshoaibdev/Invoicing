<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessPayment extends FormRequest
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
        // card validation
        return [
            'card_number' => ['required', 'numeric', 'digits:16'],
            'card_expiry' => ['required', 'date_format:m/y'],
            'card_cvv' => ['required', 'numeric', 'digits:3'],
            'card_name' => ['required', 'string', 'max:255'],
            // 'card_address' => ['required', 'string', 'max:255'],
            // 'card_city' => ['required', 'string', 'max:255'],
            // 'card_state' => ['required', 'string', 'max:255'],
            // 'card_zip' => ['required', 'numeric', 'digits:5'],
        ];
    }
}
