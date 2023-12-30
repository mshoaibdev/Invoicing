<?php

namespace App\Http\Requests\Company;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('companies')->ignore($this->header('company'), 'id'),
                'string'
            ],
            'currency_id' => [
                'required'
            ],
            'country_id' => [
                'required'
            ],
            'logo' => [
                'nullable',
                'image',
                'max:10240'
            ],
            'address.name' => [
                'nullable',
            ],
            'address.address_street_1' => [
                'nullable',
            ],
            'address.city' => [
                'nullable',
            ],
            'address.state' => [
                'nullable',
            ],
            'address.country_id' => [
                'required',
            ],
            'address.zip' => [
                'nullable',
            ],
            'address.phone' => [
                'nullable',
            ],
            
        ];
    }

    public function getCompanyPayload()
    {
        return collect($this->validated())
            ->merge([
                'creator_id' => $this->user()->id,
                'slug' => Str::slug($this->name)
            ])
            ->toArray();
    }

    public function getAddressPayload()
    {
        return collect($this->validated())
            ->only([
                'address.name',
                'address.address_street_1',
                'address.address_street_2',
                'address.city',
                'address.state',
                'address.country_id',
                'address.zip',
                'address.phone',
                'address.fax',
            ])
            ->toArray();
    }
}
