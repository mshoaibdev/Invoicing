<?php

namespace App\Http\Requests\Estimate;

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
            'title' => ['required', 'string'],
            'estimate_date' => ['required', 'date'],
            'expiry_date' => ['required', 'date_format:Y-m-d H:i'],
            'customer_id' =>['required', 'date_format:Y-m-d H:i'],
            'salesman_id' => ['required', 'integer'],
            'notes' => ['nullable', 'string'],
            'sub_total' => ['required'],
            'total' => ['required'],
            // 'tax' => ['required'],
            // 'grand_total' => ['required'],
            'items' => ['required', 'array'],
        ];
    }
}
