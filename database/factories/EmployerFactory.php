<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'firstName' => fake()->name(),
            'lastName' => fake()->name(),
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'mobileNumber' => fake()->unique()->phoneNumber(),
            'image' => 'https://placehold.co/600x400.png',
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'zip' => fake()->postcode(),
            'addressline' => fake()->address(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
