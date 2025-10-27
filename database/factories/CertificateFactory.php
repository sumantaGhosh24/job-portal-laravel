<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'issuing_organization' => fake()->unique()->word(),
            'issue_date' => fake()->date(),
            'user_id' => fake()->randomElement(User::all()->pluck('id')->toArray())
        ];
    }
}
