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
        'date',
        'time',
        'name',
        'email',
        'phone_number',
    ];

    // Relationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
