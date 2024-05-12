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
        $pass = Hash::make('admin_root');

        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Shea254',
                'email' => 'admin@shea254.com',
                'phone_number' => '+254 711 894 267',
                'password' => $pass,
                'user_level' => 1
            ]
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}
