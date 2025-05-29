<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'duration',
        'max_participants',
        'materials_included',
        'instructor_id',
        'location_id',
    ];

    // Relationships
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'bookings');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
