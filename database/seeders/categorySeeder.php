<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Fruits',"media_id" =>1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vegetables',"media_id" =>2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dairy',"media_id" =>4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Meat',"media_id" =>3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beverages',"media_id" =>5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
