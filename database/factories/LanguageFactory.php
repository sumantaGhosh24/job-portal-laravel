<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'proficiency' => fake()->randomElement(['elementary', 'limited-working', 'professional-working', 'full-professional', 'native-or-bilingual']),
            'user_id' => fake()->randomElement(User::all()->pluck('id')->toArray())
        ];
    }
}
