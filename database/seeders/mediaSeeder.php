<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class mediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    DB::table('media')->insert([
        [
            'parent_id' => 1,
            'parent_type' => 'App\Models\Post',
            'image_type' => 'thumbnail',
            'path' => 'images/posts/thumbnail1.jpg',
            'size' => 2048,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'parent_id' => 2,
            'parent_type' => 'App\Models\Post',
            'image_type' => 'banner',
            'path' => 'images/posts/banner1.jpg',
            'size' => 4096,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'parent_id' => 3,
            'parent_type' => 'App\Models\User',
            'image_type' => 'profile',
            'path' => 'images/users/profile1.jpg',
            'size' => 1024,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
    ]);
    }
}
