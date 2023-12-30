<?php

namespace App\Http\Requests\Company;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
                Rule::unique('companies'),
                'string'
            ],
            'currency_id' => [
                'required'
            ],
            'country_id' => [
                'required'
            ],
            'logo' => [
                'required',
                'image',
                'max:10240'
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
}
