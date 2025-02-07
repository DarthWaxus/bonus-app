<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OperationStatusSeeder::class,
            OperationTypeSeeder::class,
            BonusProgramSeeder::class,
            UserSeeder::class
        ]);
    }
}
