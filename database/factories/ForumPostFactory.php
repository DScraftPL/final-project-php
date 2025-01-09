<?php

namespace Database\Factories;

use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class ForumPostFactory extends Factory
{
    protected $model = ForumPost::class;
    public function definition(): array
    {
        return [
            'content' => fake()->paragraph,
            'author_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
