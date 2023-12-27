<?php

namespace App\Http\Requests\Project;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'contact_info' => ['required'],
            'price' => ['required'],
            'user_id' => ['required'],
            'type' => ['required'],
            'time' => ['required'],
            'added_date' => ['required', 'date'],
            'last_worked_on' => ['nullable', 'date'],
            'description' => ['nullable'],
            'status' => ['nullable'],
        ];
    }
}
