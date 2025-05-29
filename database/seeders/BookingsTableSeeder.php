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
        // Booking for User 1, Instructor 2
        Booking::create([
            'user_id' => 1,
            'lesson_id' => 1,
            'date' => now()->addDays(2)->toDateString(),
            'time' => '10:00:00',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone_number' => '0612345678',
            'instructor_id' => 2,
        ]);

        // Booking for User 1, Instructor 3
        Booking::create([
            'user_id' => 1,
            'lesson_id' => 2,
            'date' => now()->addDays(5)->toDateString(),
            'time' => '14:00:00',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone_number' => '0612345678',
            'instructor_id' => 3,
        ]);

        // Booking for User 2, Instructor 2
        Booking::create([
            'user_id' => 2,
            'lesson_id' => 1,
            'date' => now()->addDays(3)->toDateString(),
            'time' => '09:00:00',
            'name' => 'Alice Example',
            'email' => 'alice@example.com',
            'phone_number' => '0623456789',
            'instructor_id' => 2,
        ]);

        // Booking for User 3, Instructor 4
        Booking::create([
            'user_id' => 3,
            'lesson_id' => 3,
            'date' => now()->addDays(4)->toDateString(),
            'time' => '13:00:00',
            'name' => 'Bob Example',
            'email' => 'bob@example.com',
            'phone_number' => '0634567890',
            'instructor_id' => 4,
        ]);

        // Booking for User 4, Instructor 3
        Booking::create([
            'user_id' => 4,
            'lesson_id' => 2,
            'date' => now()->addDays(6)->toDateString(),
            'time' => '15:00:00',
            'name' => 'Carol Example',
            'email' => 'carol@example.com',
            'phone_number' => '0645678901',
            'instructor_id' => 3,
        ]);
    }
}
