<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use App\Models\user;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => fake()->sentence(6),
            'body'        => fake()->paragraphs(3, true),
            'category_id' => Category::inRandomOrder()->value('id'),
            'user_id'     => User::inRandomOrder()->value('id') ?? User::factory(),
        ];
    }
}
