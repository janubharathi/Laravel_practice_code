<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Tech',      'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Travel',    'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lifestyle', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}