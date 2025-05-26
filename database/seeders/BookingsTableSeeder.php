<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'user_id' => 1, // assumes user with id 1 exists
            'lesson_id' => 1,
            'date' => now()->addDays(2)->toDateString(),
            'time' => '10:00:00',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone_number' => '0612345678',
            'instructor_id' => 1,
        ]);
        Booking::create([
            'user_id' => 1,
            'lesson_id' => 2,
            'date' => now()->addDays(5)->toDateString(),
            'time' => '14:00:00',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone_number' => '0612345678',
            'instructor_id' => 1,
        ]);
    }
}
