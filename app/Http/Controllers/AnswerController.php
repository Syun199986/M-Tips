<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;

class AnswerController extends Controller
{
    public function postAnswer(Answer $answer)
    {
        return view('post_answer');
    }
    public function allAnswers(Answer $answer)
    {
        return view('all_answers');
    }
    public function myPostedAnswers(Answer $answer)
    {
        return view('my_posted_answers');
    }
    public function editAnswer(Answer $answer)
    {
        return view('edit_answer');
    }
}
