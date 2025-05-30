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
            'address' => 'Adminstraat 1',
            'city' => 'Adminstad',
            'birthdate' => '1980-01-01',
            'bsn_number' => '111111111',
            'mobile' => '0611111111',
        ]);

        User::factory()->create([
            'name' => 'Klant Demo',
            'email' => 'klant@example.com',
            'role_id' => 3, // Assuming 3 is the customer role
            'password' => bcrypt('1'),
            'address' => 'Klantstraat 10',
            'city' => 'Klantendam',
            'birthdate' => '1995-05-15',
            'mobile' => '0622222222',
        ]);

        $this->call([
            RolesTableSeeder::class,
            instructorsTableSeeder::class,
            LocationsTableSeeder::class,
            LessonsTableSeeder::class,
            BookingsTableSeeder::class,
        ]);
    }
}
