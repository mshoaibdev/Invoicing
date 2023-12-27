<?php

namespace App\Http\Requests\Services;

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
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['nullable'],
            'start_date' => ['required', 'date_format:Y-m-d H:i'],
            'end_date' => ['required' , 'date_format:Y-m-d H:i'],
            'address' => ['nullable'],
            'services' => ['nullable'],
            'customer_id' => ['required'],
        ];
    }
}
