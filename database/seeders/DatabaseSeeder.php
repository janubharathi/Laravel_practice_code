<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Tech', 'Travel', 'Lifestyle'] as $name){
            Category::firstOrCreate(['name' => $name]);
        }
        Post::factory(20)->create();
    }
}