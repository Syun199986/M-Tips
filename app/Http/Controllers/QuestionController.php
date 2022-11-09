<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;

class QuestionController extends Controller
{
    public function home(Question $question)
    {
        return view('home');
    }
    public function postQuestion(Question $question)
    {
        return view('post_question');
    }
    public function myPostedQuestions(Question $question)
    {
        return view('my_posted_questions');
    }
    public function editQuestion(Question $question)
    {
        return view('edit_question');
    }
}
