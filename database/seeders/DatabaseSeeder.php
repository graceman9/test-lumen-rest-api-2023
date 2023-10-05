<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // NOTE: maybe implement artisan command to control seeding count via CLI.
        $this->callWith(UserSeeder::class, ['count' => 3, 'countCompanies' => 3]);
    }
}
