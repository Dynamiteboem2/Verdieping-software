<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lessons')->insert([
            [
                'type' => 'Privéles',
                'price' => 175.00,
                'duration' => '2.5 uur',
                'max_participants' => 1,
                'materials_included' => 'Inclusief alle materialen',
                'instructor_id' => 1, // Default instructor
                'location_id' => 1,
            ],
            [
                'type' => 'Losse Duo Kiteles',
                'price' => 135.00,
                'duration' => '3.5 uur',
                'max_participants' => 2,
                'materials_included' => 'Inclusief alle materialen',
                'instructor_id' => 2, // Default instructor
                'location_id' => 2,
            ],
            [
                'type' => 'Kitesurf Duo lespakket 3 lessen',
                'price' => 375.00,
                'duration' => '10.5 uur',
                'max_participants' => 2,
                'materials_included' => 'Inclusief alle materialen',
                'instructor_id' => 3, // Default instructor
                'location_id' => 3,
            ],
            [
                'type' => 'Kitesurf Duo lespakket 5 lessen',
                'price' => 675.00,
                'duration' => '17.5 uur',
                'max_participants' => 2,
                'materials_included' => 'Inclusief alle materialen',
                'instructor_id' => 4, // Default instructor
                'location_id' => 4,
            ],
        ]);
    }
}
