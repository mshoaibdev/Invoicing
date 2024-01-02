<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email,'.$this->user()->id],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4048'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address.phone' => ['nullable', 'string', 'max:30'],
            'address.address_street_1' => ['nullable', 'string', 'max:255'],
            'address.city' => ['nullable', 'string', 'max:50'],
            'address.state' => ['nullable', 'string', 'max:50'],
            'address.country_id' => ['required'],
            'address.zip' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function getUserPayload()
    {
        return collect($this->validated())
            ->merge([
                'creator_id' => $this->user()->id,
            ])
            ->toArray();
    }

    public function getAddressPayload()
    {
        return collect($this->validated()['address'])
            ->merge([
                'type' => 'home',
            ])
            ->toArray();
    }

    public function hasAddress(array $address)
    {
        $data = \Arr::where($address, function ($value, $key) {
            return isset($value);
        });

        return $data;
    }

}
