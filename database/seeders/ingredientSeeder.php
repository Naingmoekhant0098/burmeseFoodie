<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ingredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
    DB::table('ingredient_recipe')->insert([
        [
            'recipe_id' => 1,
            'ingredient_id' => 1,
            'amount' => 100,
            'unit' => 'grams',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'recipe_id' => 1,
            'ingredient_id' => 2,
            'amount' => 200,
            'unit' => 'ml',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'recipe_id' => 1,
            'ingredient_id' => 3,
            'amount' => 50,
            'unit' => 'pieces',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);

    }
}
