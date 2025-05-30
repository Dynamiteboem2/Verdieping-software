<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'instructor_id' => 'required|exists:users,id',
            'date' => [
                'required',
                'date_format:d/m/Y',
                'after_or_equal:' . now()->addWeek()->format('d/m/Y'),
            ],
            'time' => [
                'required',
                'date_format:H:i',
                'after_or_equal:09:00',
                'before_or_equal:18:00',
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[^@]+@[^@]+\.[^@]+$/'
            ],
            'phone_number' => 'required|string|max:15',
            'duo_name' => 'nullable|string|max:255',
            'duo_email' => [
                'nullable',
                'email',
                'max:255',
                'regex:/^[^@]+@[^@]+\.[^@]+$/'
            ],
            'location_id' => 'required|string',
        ];
    }
}
