<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            [
                "full_name" => "Catherine mueni",
                "email" => "catemueni260@gmail.com",
                "phone_number" => "0758442658",
                "message" => "Alovevera jel",
                "created_at" => "2024-04-06 08:05:13",
                "updated_at"=> "2024-04-06 08:05:13",
            ],
            [
                "full_name" => "Catherine mueni",
                "email" => "catemueni260@gmail.com",
                "phone_number" => "0758442658",
                "message" => "I need those products",
                "created_at" => "2024-04-06 08:05:13",
                "updated_at"=> "2024-04-06 08:05:13",
            ],
            [
                "full_name" => "Catherine mueni",
                "email" => "catemueni260@gmail.com",
                "phone_number" => "0758442658",
                "message" => "Need those products",
                "created_at" => "2024-04-06 08:05:13",
                "updated_at"=> "2024-04-06 08:05:13",
            ],
            [
                "full_name" => "Catherine mueni",
                "email" => "catemueni260@gmail.com",
                "phone_number" => "0758442658",
                "message" => "I need to shop those products",
                "created_at" => "2024-04-06 08:05:13",
                "updated_at"=> "2024-04-06 08:05:13",
            ],
            [
                "full_name" => "Catherine mueni",
                "email" => "catemueni260@gmail.com",
                "phone_number" => "0758442658",
                "message" => "I need those products",
                "created_at" => "2024-04-06 08:05:13",
                "updated_at"=> "2024-04-06 08:05:13",
            ],
        ];

        foreach($comments as $comment) {
            Comment::create([
                'full_name' => $comment['full_name'],
                'email' => $comment['email'],
                'phone_number' => $comment['phone_number'],
                'message' => $comment['message'],
                'created_at' => $comment['created_at'],
                'updated_at' => $comment['updated_at'],
            ]);
        }
    }
}
