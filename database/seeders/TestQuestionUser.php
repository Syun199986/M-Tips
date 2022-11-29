<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TestQuestionUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_user')->insert([
            [
                'user_id' => '1',
                'question_id' => '1'
            ],
            [
                'user_id' => '2',
                'question_id' => '2'
            ],
         ]);
    }
}
