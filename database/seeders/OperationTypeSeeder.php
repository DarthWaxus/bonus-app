<?php

namespace Database\Seeders;

use App\Enums\OperationTypeEnum;
use App\Models\OperationType;
use Illuminate\Database\Seeder;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (OperationTypeEnum::toArray() as $id => $name) {
            OperationType::updateOrInsert(['id' => $id], ['name' => $name]);
        }
    }
}
