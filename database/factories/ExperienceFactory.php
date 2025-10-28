<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'job_title' => fake()->unique()->word(),
            'company_name' => fake()->unique()->word(),
            'location' => fake()->unique()->word(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'user_id' => fake()->randomElement(User::all()->pluck('id')->toArray())
        ];
    }
}
