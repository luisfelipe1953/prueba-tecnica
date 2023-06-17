<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
            'identification_number' => 'required|numeric|unique:users,identification_number,',
            'cell_phone' => 'required|min:10|max:20|unique:users,cell_phone,',
            'email' => 'required|min:4|max:255|email|unique:users,email,',
            'address' => 'required|min:4|max:255',
            'note' => 'required|min:4|max:255',
        ];
    }
}
