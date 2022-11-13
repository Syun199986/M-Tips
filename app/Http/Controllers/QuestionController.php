<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use App\Http\Requests\QuestionPostRequest;

class QuestionController extends Controller
{
    public function home(Question $question)
    {
        return view('questions/home')->with(['questions' => $question->get()]);
    }
    public function postQuestion(Question $question)
    {
        return view('questions/post_question');
    }
    public function storeQuestion(QuestionPostRequest $request, Question $question)
    {
        $input = $request['question'];
        $question->fill($input)->save();
        return redirect('/home');
    }
    public function editQuestion(Question $question)
    {
        return view('questions/edit_question')->with(['question' => $question]);
    }
    public function questionUpdate(QuestionPostRequest $request, Question $question)
    {
        $input_question = $request['question'];
        $question->fill($input_question)->save();
        return redirect('/home');
    }
    public function deleteQuestion(Question $question)
    {
        $question->delete();
        return redirect('/home');
    }
    public function myPostedQuestions(Question $question)
    {
        return view('questions/my_posted_questions');
    }
}
