<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(25)->create();

        Employer::factory(5)->create();

        Admin::factory(2)->create();
    }
}
