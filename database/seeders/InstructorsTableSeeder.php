<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class InstructorsTableSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            [
                'name' => 'Duco Veenstra',
                'email' => 'duco@kitesurf.com',
                'address' => 'Strandlaan 1',
                'city' => 'Zandvoort',
                'birthdate' => '1985-04-12',
                'bsn_number' => '123456789',
                'mobile' => '0612345678',
            ],
            [
                'name' => 'Waldemar van Dongen',
                'email' => 'waldemar@kitesurf.com',
                'address' => 'Duinweg 22',
                'city' => 'Noordwijk',
                'birthdate' => '1982-07-23',
                'bsn_number' => '987654321',
                'mobile' => '0623456789',
            ],
            [
                'name' => 'Ruud Terlingen',
                'email' => 'ruud@kitesurf.com',
                'address' => 'Kuststraat 5',
                'city' => 'Scheveningen',
                'birthdate' => '1990-11-02',
                'bsn_number' => '456789123',
                'mobile' => '0634567890',
            ],
            [
                'name' => 'Saskia Brink',
                'email' => 'saskia@kitesurf.com',
                'address' => 'Zeeweg 10',
                'city' => 'Bloemendaal',
                'birthdate' => '1993-03-15',
                'bsn_number' => '654321987',
                'mobile' => '0645678901',
            ],
            [
                'name' => 'Bernie Vredenstein',
                'email' => 'bernie@kitesurf.com',
                'address' => 'Waterkant 8',
                'city' => 'Katwijk',
                'birthdate' => '1988-09-30',
                'bsn_number' => '321987654',
                'mobile' => '0656789012',
            ],
        ];

        foreach ($instructors as $instructor) {
            User::create([
                'name' => $instructor['name'],
                'email' => $instructor['email'],
                'password' => bcrypt('password'),
                'role_id' => 2,
                'is_active' => true,
                'address' => $instructor['address'],
                'city' => $instructor['city'],
                'birthdate' => $instructor['birthdate'],
                'bsn_number' => $instructor['bsn_number'],
                'mobile' => $instructor['mobile'],
            ]);
        }
    }
}
