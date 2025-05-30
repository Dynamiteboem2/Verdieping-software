<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'birthdate' => 'required|date_format:d-m-Y',
            'mobile' => 'required|string|max:20',
            'landline' => 'nullable|string|max:20',
        ];
    }
}
