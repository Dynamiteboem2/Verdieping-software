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
        // Accept both 'user' and 'userId' as route parameter for flexibility
        $userId = $this->route('user') ?? $this->route('userId');
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
