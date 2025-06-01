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
                function ($attribute, $value, $fail) {
                    $date = $this->input('date');
                    $instructorId = $this->input('instructor_id');
                    $lessonId = $this->input('lesson_id');
                    if (!$date || !$instructorId || !$lessonId) {
                        return;
                    }
                    // Parse date and time
                    try {
                        $dateObj = \Carbon\Carbon::createFromFormat('d/m/Y', $date);
                        $startTime = \Carbon\Carbon::createFromFormat('H:i', $value);
                    } catch (\Exception $e) {
                        return;
                    }
                    // Get lesson duration in hours
                    $lesson = \App\Models\Lesson::find($lessonId);
                    if (!$lesson) return;
                    $duration = (int) $lesson->duration; // assuming duration is in hours

                    // Calculate end time (+duration)
                    $endTime = (clone $startTime)->addHours($duration);

                    // Add 1 hour buffer after lesson
                    $endTimeWithBuffer = (clone $endTime)->addHour();

                    // Query for overlapping bookings for this instructor on this date
                    $overlap = \App\Models\Booking::where('instructor_id', $instructorId)
                        ->where('date', $dateObj->format('Y-m-d'))
                        ->where(function ($query) use ($startTime, $endTimeWithBuffer) {
                            $query->where(function ($q) use ($startTime, $endTimeWithBuffer) {
                                $q->whereRaw('STR_TO_DATE(time, "%H:%i") < ?', [$endTimeWithBuffer->format('H:i')])
                                  ->whereRaw('ADDTIME(time, SEC_TO_TIME(lesson_duration * 3600)) > ?', [$startTime->format('H:i')]);
                            });
                        })
                        ->exists();

                    if ($overlap) {
                        $fail('De instructeur is niet beschikbaar op dit tijdstip. Kies een ander tijdstip.');
                    }
                },
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
