<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => 1, 
            'password' => bcrypt('1'), 
        ]);
        $this->call([
            RolesTableSeeder::class,
            InstructorsTableSeeder::class,
            LocationsTableSeeder::class,
            LessonsTableSeeder::class,
            BookingsTableSeeder::class,
        ]);
    }
}
