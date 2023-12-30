<?php

namespace App\Http\Requests\Customer;

use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
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
            'email' => ['email', 'required', Rule::unique('customers')->where('company_id', $this->header('company'))],
            'phone' => ['nullable', 'string', 'max:150'],
            'billing.name' => ['nullable'],
            'billing.address_street_1' => ['nullable'],
            'billing.city' => ['nullable'],
            'billing.state' => ['nullable'],
            'billing.country_id' => ['nullable'],
            'billing.zip' => ['nullable'],
            'currency_id' => ['required'],
            'company_name' => ['nullable'],
            'website' => ['nullable'],
        ];
    }

    public function getCustomerPayload()
    {
        return collect($this->validated())
            ->merge([
                'creator_id' => $this->user()->id,
                'company_id' => $this->header('company'),
            ])
            ->toArray();
    }

    public function getBillingAddress()
    {
        return collect($this->billing)
            ->merge([
                'user_id' => $this->user()->id,
                'company_id' => $this->header('company'),
                'type' => 'billing',
            ])
            ->toArray();
    }

    public function hasAddress(array $address)
    {
        $data = Arr::where($address, function ($value, $key) {
            return isset($value);
        });

        return $data;
    }

}
