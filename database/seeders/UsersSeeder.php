<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "first_name" => "Admin",
                "last_name" => "Administrator",
                "email" => "admin@gmail.com",
                "phone_number" => "254746055487",
                "password"=> Hash::make("@dmin"),
                "user_level" => 2,
            ],
            [
                "first_name" => "User",
                "last_name" => "Test",
                "email" => "user@gmail.com",
                "phone_number" => "254746055487",
                "password"=> Hash::make("p@ssword"),
            ],
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}
