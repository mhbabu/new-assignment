<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Blog::class;

    public function definition()
    {
        $title   = $this->faker->sentence;
        $slug    = Str::slug($title); // Making slug from title

        $userIds = User::pluck('id'); // For taking existing user id from users table
        $userId  = $this->faker->randomElement($userIds); // It will pick random user id

        return [
            'title'      => $title,
            'slug'       => $slug,
            'details'    => $this->faker->text(400),
            'created_by' => 1,
            'created_at' => now(),
            'created_by' => $userId,
            'updated_at' => now(),
            'updated_by' => $userId
        ];
    }
}
