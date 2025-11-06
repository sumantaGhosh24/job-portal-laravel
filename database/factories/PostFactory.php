<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory {
    public function definition(): array {
        return [
            'title' => $this->faker->sentence(1),
            'description' => $this->faker->sentence(3),
            'content' => $this->faker->text(500),
            'user_id' => fake()->randomElement(User::all()->pluck('id')->toArray())
        ];
    }
}
