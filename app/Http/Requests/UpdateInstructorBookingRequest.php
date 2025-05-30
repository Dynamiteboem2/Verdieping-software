<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstructorBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'time' => [
                'required',
                'date_format:H:i',
                'after_or_equal:09:00',
                'before_or_equal:18:00',
            ],
            'user.name' => 'required|string|max:255',
            'user.email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[^@]+@[^@]+\.[^@]+$/'
            ],
            'user.mobile' => 'nullable|string|max:20',
            'location_id' => 'required|string',
        ];
    }
}
