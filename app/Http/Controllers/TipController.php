<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;

class TipController extends Controller
{
    public function home(Tip $tip)
    {
        return view('home');
    }
    public function postQuestion(Tip $tip)
    {
        return view('post_question');
    }
    public function myPostedQuestions(Tip $tip)
    {
        return view('my_posted_questions');
    }
    public function postAnswer(Tip $tip)
    {
        return view('post_answer');
    }
    public function allAnswers(Tip $tip)
    {
        return view('all_answers');
    }
    public function myPostedAnswers(Tip $tip)
    {
        return view('my_posted_answers');
    }
}
