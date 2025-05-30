<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');
        return [
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $userId,
                'regex:/^[^@]+@[^@]+\.[^@]+$/'
            ],
            'role_id' => 'required|integer|exists:roles,id',
        ];
    }
}
