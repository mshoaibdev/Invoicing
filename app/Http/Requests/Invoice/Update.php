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
            'invoice_date' => ['required', 'date'],
            'items' => ['required', 'array'],
            'total' => ['required', 'numeric'],
            'subtotal' => ['required', 'numeric'],
            'payment_method_id' => ['required'],
            'customer_id' => ['required'],
            'note' => ['nullable', 'string'],
            'terms' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'vat_amount' => ['nullable', 'numeric'],
            'vat_percentage' => ['nullable', 'numeric'],
            'tax_amount' => ['nullable', 'numeric'],
            'tax_percentage' => ['nullable', 'numeric'],
        ];
    }

    public function getInvoicePayload(): array
    {
        return collect($this->validated())
           
            ->toArray();
    }
}
