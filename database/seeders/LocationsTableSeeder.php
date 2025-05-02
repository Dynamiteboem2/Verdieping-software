<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('locations')->insert([
            ['name' => 'Zandvoort'],
            ['name' => 'Muiderberg'],
            ['name' => 'Wijk aan Zee'],
            ['name' => 'IJmuiden'],
            ['name' => 'Scheveningen'],
            ['name' => 'Hoek van Holland'],
        ]);
    }
}
