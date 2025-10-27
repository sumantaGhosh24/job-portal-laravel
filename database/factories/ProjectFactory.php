<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->word(),
            'description' => fake()->paragraph(),
            'github_url' => 'https://github.com',
            'user_id' => fake()->randomElement(User::all()->pluck('id')->toArray())
        ];
    }
}
