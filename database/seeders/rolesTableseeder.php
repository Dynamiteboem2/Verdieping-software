<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrator'],
            ['name' => 'instructor'],
            ['name' => 'customer'],
            ['name' => 'Guest'],
        ];

        DB::table('roles')->insert($roles);
    }
}