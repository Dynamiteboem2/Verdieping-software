<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('instructors')->insert([
            ['name' => 'Duco Veenstra'],
            ['name' => 'Waldemar van Dongen'],
            ['name' => 'Ruud Terlingen'],
            ['name' => 'Saskia Brink'],
            ['name' => 'Bernie Vredenstein'],
        ]);
    }
}
