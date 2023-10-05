<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($count = 1, $countCompanies = 3): void
    {
        if (!User::exists()) {
            User::factory()
                ->count($count)
                ->hasCompanies($countCompanies)
                ->create();
        }
    }
}
