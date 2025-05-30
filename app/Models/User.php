<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activation_token', 
        'is_active',
        'role_id',
        'address',
        'city',
        'birthdate',
        'mobile',
        'bsn_number',
        'landline', // <-- Add this line to make landline storable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lessons()
    {
        return $this->belongsToMany(\App\Models\Lesson::class, 'bookings');
    }
    
    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
    
    public function instructorBookings()
    {
        return $this->hasMany(\App\Models\Booking::class, 'instructor_id');
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }
}
