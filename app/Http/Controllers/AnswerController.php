<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use App\Http\Requests\AnswerPostRequest;
use Illuminate\Support\Facades\Storage;

class AnswerController extends Controller
{
    public function allAnswers(Answer $answer, Question $question)
    {
        return view('answers/all_answers')->with(['answers' => $answer->where('question_id', $question->id)->get()])->with(['question' => $question]);
    }
    public function postAnswer(Answer $answer, Question $question)
    {
        return view('answers/post_answer')->with(['question' => $question]);
    }
    public function storeAnswer(Request $req, AnswerPostRequest $request, Answer $answer, Question $question)
    {
        $input = $request['answer'];
        $answer->fill($input)->save();

        //ファイルの保存
        if($req->answer_file){
        
            if($req->answer_file->extension() == 'gif' 
            || $req->answer_file->extension() == 'jpeg' 
            || $req->answer_file->extension() == 'jpg' 
            || $req->answer_file->extension() == 'png'
            || $req->answer_file->extension() == 'mp3')
            {
                $req->file('answer_file')->storeAs('public/answer_file', $answer->id.'.'.$req->answer_file->extension());
                $answer->where('id', $answer->id)->update(['file_path' => "/storage/answer_file/".$answer->id.'.'.$req->answer_file->extension()]);
            }
        }        
        
        return redirect('/'.$question->id.'/all_answers');
    }
    public function editAnswer(Question $question, Answer $answer)
    {
        return view('answers/edit_answer')->with(['question' => $question])->with(['answer' => $answer]);
    }
    public function deleteFile(Request $req, AnswerPostRequest $request, Answer $answer)
    {
        $answer->where('id', $answer->id)->update(['file_path' => NULL]);
        return redirect('/answers/'.$answer->id.'/edit_answer');
    }
    public function answerUpdate(Request $req, AnswerPostRequest $request, Answer $answer)
    {
        $input = $request['answer'];
        $answer->fill($input)->save();

        //ファイルの保存
        if($req->answer_file){
        
            if($req->answer_file->extension() == 'gif' 
            || $req->answer_file->extension() == 'jpeg' 
            || $req->answer_file->extension() == 'jpg' 
            || $req->answer_file->extension() == 'png'
            || $req->answer_file->extension() == 'mp3')
            {
                $req->file('answer_file')->storeAs('public/answer_file', $answer->id.'.'.$req->answer_file->extension());
                $answer->where('id', $answer->id)->update(['file_path' => "/storage/answer_file/".$answer->id.'.'.$req->answer_file->extension()]);
            }
        }        
        
        return redirect('/'.$answer->question_id.'/all_answers');
    }
    public function deleteAnswer(Answer $answer)
    {
        $answer->delete();
        return redirect('/'.$answer->question_id.'/all_answers');
    }
    public function myPostedAnswers(Answer $answer)
    {
        return view('answers/my_posted_answers');
    }
}
