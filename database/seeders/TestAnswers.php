<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\Answer;

class TestAnswers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            [
                'question_id' => 1,
                'user_name' => 'TestUser2',
                'body' => 'TestUser2の回答です',
                'file_path' => NULL,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'deleted_at' => NULL
            ],
            [
                'question_id' => 2,
                'user_name' => 'TestUser',
                'body' => 'TestUserの回答です',
                'file_path' => NULL,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'deleted_at' => NULL
            ],
        ]);
    }
}
