<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'operator',
            'name' => 'Operator RRI',
            'password' => Hash::make('operator123'), // Hash password
            'role' => 'operator',
        ]);
    }
}
