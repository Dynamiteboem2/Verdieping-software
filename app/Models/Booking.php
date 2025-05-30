<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'instructor_id',
        'user_id',
        'date',
        'time',
        'name',
        'email',
        'phone_number',
        'status',
        'is_paid',
        'duo_name',
        'duo_email',
        'cancellation_reason',
        'cancellation_approved',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function instructor()
    {
        return $this->belongsTo(\App\Models\User::class, 'instructor_id');
    }

    public function lesson()
    {
        return $this->belongsTo(\App\Models\Lesson::class, 'lesson_id');
    }
}
