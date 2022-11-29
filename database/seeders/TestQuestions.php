<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\Question;

class TestQuestions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'category_id' => 1,
                'title' => 'TestUserの質問',
                'user_name' => 'TestUser',
                'body' => 'TestUserの質問です',
                'file_path' => NULL,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'deleted_at' => NULL
            ],
            [
                'category_id' => 1,
                'title' => 'TestUser2の質問',
                'user_name' => 'TestUser2',
                'body' => 'TestUser2の質問です',
                'file_path' => NULL,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'deleted_at' => NULL
            ],
        ]);
    }
}
