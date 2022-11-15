<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use App\Http\Requests\QuestionPostRequest;
use Illuminate\Support\Facades\Storage;

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
    public function storeQuestion(Request $req, QuestionPostRequest $request, Question $question)
    {
        $input = $request['question'];
        $question->fill($input)->save();

        //ファイルの保存
        if($req->question_file){
        
            if($req->question_file->extension() == 'gif' 
            || $req->question_file->extension() == 'jpeg' 
            || $req->question_file->extension() == 'jpg' 
            || $req->question_file->extension() == 'png'
            || $req->question_file->extension() == 'mp3')
            {
                $req->file('question_file')->storeAs('public/question_file', $question->id.'.'.$req->question_file->extension());
                $question->where('id', $question->id)->update(['file_path' => "/storage/question_file/".$question->id.'.'.$req->question_file->extension()]);
            }
        }        
        
        return redirect('/home');
    }
    public function editQuestion(Request $req, Question $question)
    {
        return view('questions/edit_question')->with(['question' => $question]);
    }
    public function deleteFile(Request $req, QuestionPostRequest $request, Question $question)
    {
        $question->where('id', $question->id)->update(['file_path' => NULL]);
        return redirect('/questions/'.$question->id.'/edit_question');
    }
    public function questionUpdate(Request $req, QuestionPostRequest $request, Question $question)
    {
        $input_question = $request['question'];
        $question->fill($input_question)->save();
        
        //ファイルの保存
        if($req->question_file){
        
            if($req->question_file->extension() == 'gif' 
            || $req->question_file->extension() == 'jpeg' 
            || $req->question_file->extension() == 'jpg' 
            || $req->question_file->extension() == 'png'
            || $req->question_file->extension() == 'mp3')
            {
                $req->file('question_file')->storeAs('public/question_file', $question->id.'.'.$req->question_file->extension());
                $question->where('id', $question->id)->update(['file_path' => "/storage/question_file/".$question->id.'.'.$req->question_file->extension()]);
            }
        }        
        
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
