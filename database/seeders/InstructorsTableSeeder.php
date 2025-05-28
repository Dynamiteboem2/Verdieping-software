<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class InstructorsTableSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            ['name' => 'Duco Veenstra', 'email' => 'duco@kitesurf.com'],
            ['name' => 'Waldemar van Dongen', 'email' => 'waldemar@kitesurf.com'],
            ['name' => 'Ruud Terlingen', 'email' => 'ruud@kitesurf.com'],
            ['name' => 'Saskia Brink', 'email' => 'saskia@kitesurf.com'],
            ['name' => 'Bernie Vredenstein', 'email' => 'kitesurf.com'],
        ];

        foreach ($instructors as $instructor) {
            // Create a user account for each instructor
            User::create([
                'name' => $instructor['name'],
                'email' => $instructor['email'],
                'password' => bcrypt('password'), // Default password
                'role_id' => 2, // Use your instructor role_id
                'is_active' => true,
            ]);
        }
    }
}
