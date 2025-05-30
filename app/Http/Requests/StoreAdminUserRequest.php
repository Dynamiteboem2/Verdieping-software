<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[^@]+@[^@]+\.[^@]+$/'
            ],
            'role_id' => 'required|integer|exists:roles,id',
            'password' => 'required|string|min:6',
        ];
    }
}
