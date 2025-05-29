<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Instructor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? 1,
            'lesson_id' => Lesson::inRandomOrder()->first()?->id ?? 1,
            'date' => now()->addDays(rand(1, 10))->toDateString(),
            'time' => sprintf('%02d:00:00', rand(8, 18)),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone_number' => '06' . rand(10000000, 99999999),
            'instructor_id' => User::where('role_id', 2)->inRandomOrder()->first()?->id,
        ];
    }
}
