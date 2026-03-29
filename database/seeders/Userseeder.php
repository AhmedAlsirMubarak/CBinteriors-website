<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@cbinteriors.com'],
            [
                'name'     => 'CB Admin',
                'password' => Hash::make('password'), // change immediately after first login
                'role'     => 'admin',
            ]
        );
    }
}