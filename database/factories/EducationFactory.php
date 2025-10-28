<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'degree' => fake()->unique()->word(),
            'field_of_study' => fake()->randomElement(['computer science', 'engineering', 'business', 'arts', 'medicine', 'law', 'education', 'agriculture', 'science', 'technology', 'other']),
            'institution_name' => fake()->unique()->word(),
            'location' => fake()->unique()->word(),
            'graduation_date' => fake()->date(),
            'user_id' => fake()->randomElement(User::all()->pluck('id')->toArray())
        ];
    }
}
