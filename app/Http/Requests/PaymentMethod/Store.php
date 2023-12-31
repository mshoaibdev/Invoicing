<?php

namespace App\Http\Requests\PaymentMethod;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_default' => ['required', 'boolean'],
            'is_enabled' => ['required', 'boolean'],
            'is_gateway' => ['required', 'boolean'],
            'live_identifier' => ['nullable', 'max:255'],
            'live_secret' => ['nullable','max:255'],
            'sandbox_identifier' => ['nullable',  'max:255'],
            'sandbox_secret' => ['nullable',  'max:255'],
            'mode' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    // getPaymentMethodPayload

    public function getPaymentMethodPayload(): array
    {
        return collect($this->validated())
            ->merge([
                'company_id' => $this->header('company'),
            ])
            ->toArray();
    }
}
