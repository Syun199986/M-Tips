<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;

class AnswerController extends Controller
{
    public function postAnswer(Question $question, Answer $answer)
    {
        return view('answers/post_answer')->with(['question' => $question]);
    }
    public function allAnswers(Answer $answer)
    {
        return view('answers/all_answers');
    }
    public function myPostedAnswers(Answer $answer)
    {
        return view('answers/my_posted_answers');
    }
    public function editAnswer(Answer $answer)
    {
        return view('answers/edit_answer');
    }
}
