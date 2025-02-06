<?php

namespace Database\Seeders;

use App\Models\BonusProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BonusProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BonusProgram::updateOrInsert(['id' => 1], ['name' => 'Default'],);
    }
}
