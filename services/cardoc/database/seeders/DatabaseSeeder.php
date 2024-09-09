<?php

namespace Database\Seeders;

use App\Models\SummerCamp;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => env('USER_EMAIL'),
        ], [
            'name' => env('USER_NAME'),
            'email' => env('USER_EMAIL'),
            'password' => Hash::make(env('USER_PASSWORD')),
        ]);
    }
}
