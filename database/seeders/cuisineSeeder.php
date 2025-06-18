<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cuisines')->insert([
            ['name' => 'Italian', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chinese', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mexican', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Indian', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'French', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Burmese', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

}
