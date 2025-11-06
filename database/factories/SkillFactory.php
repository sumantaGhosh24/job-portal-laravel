<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory {
    public function definition(): array {
        return [
            'name' => fake()->unique()->word(),
            'proficiency' => fake()->randomElement(['beginner', 'intermediate', 'advanced', 'expert']),
            'user_id' => fake()->randomElement(User::all()->pluck('id')->toArray())
        ];
    }
}
