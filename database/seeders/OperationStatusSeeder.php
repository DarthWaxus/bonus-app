<?php

namespace Database\Seeders;

use App\Enums\OperationStatusEnum;
use App\Models\OperationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OperationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (OperationStatusEnum::toArray() as $id => $name) {
            OperationStatus::updateOrInsert(['id' => $id], ['name' => $name]);
        }
    }
}
