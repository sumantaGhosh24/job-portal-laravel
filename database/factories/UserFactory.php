<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'mobile_number' => fake()->unique()->phoneNumber(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'zip' => fake()->postcode(),
            'addressline' => fake()->address(),
            'desired_job_title' => fake()->randomElement(['Developer', 'Designer', 'QA', 'Project Manager', 'Sales', 'Marketing', 'Business Analyst', 'Accountant', 'Engineer', 'Writer', 'Teacher', 'Student', 'Consultant']),
            'desired_job_type' => fake()->randomElement(['full-time', 'part-time', 'contract', 'internship', 'temporary']),
            'email_verified_at' => now(),
            'profile_image' => null,
            'background_image' => null,
            'headline' => null,
            'professional_summary' => null,
            'resume' => null,
            'linkedin_url' => null,
            'github_url' => null,
            'website_url' => null,
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
