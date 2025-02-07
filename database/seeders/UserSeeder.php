<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test1@email.email'],
            [
                'name' => 'test1@email.email',
                'password' => Hash::make('test1@email.email'),
            ]
        );
    }
}
