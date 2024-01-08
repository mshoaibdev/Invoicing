<?php

namespace App\Http\Requests\TaxType;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // ignore for current company id and id
        return [
            'name' => ['required', 'string', 'max:255', 'unique:tax_types,name,'.$this->route('tax_type')->id.',id,company_id,'.$this->header('company')],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function getTaxTypePayload(): array
    {
        return collect($this->validated())
            ->merge([
                'company_id' => $this->header('company'),
            ])
            ->toArray();
    }
}
