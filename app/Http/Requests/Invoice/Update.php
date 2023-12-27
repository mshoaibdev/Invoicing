<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'due_date' => ['required', 'date'],
            'items' => ['required', 'array'],
            'total' => ['required', 'numeric'],
            'subtotal' => ['required', 'numeric'],
            'payment_method' => ['required', 'string'],
            'customer_id' => ['required'],
            'note' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'currency' => ['required', 'string'],
        ];
    }
}
