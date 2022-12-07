<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use App\Http\Requests\AnswerPostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function allAnswers(Answer $answer, Question $question, Request $request)
    {
        //検索機能
        $range = $request->range;
        $keyword = $request->input('keyword');
        $query = Answer::query();
        
        if(!empty($keyword)) {
            
            if($range == 'all') {
            $query->where('body', 'LIKE', "%{$keyword}%")
                ->orWhere('user_name', 'LIKE', "%{$keyword}%");
            } elseif ($range == 'body') {
                $query->where('body', 'LIKE', "%{$keyword}%");
            } elseif ($range == 'user_name') {
                $query->where('user_name', 'LIKE', "%{$keyword}%");
            } else {
                $query->where('body', 'LIKE', "%{$keyword}%")
                ->orWhere('user_name', 'LIKE', "%{$keyword}%");
            }
            
        }
        
        $answers = $query->where('question_id', $question->id)->get();
        
        return view('answers/all_answers', compact('answers', 'question', 'keyword'));
        
        // return view('answers/all_answers')->with(['answers' => $answer->where('question_id', $question->id)->get()])->with(['question' => $question]);
    }
    public function postAnswer(Answer $answer, Question $question)
    {
        return view('answers/post_answer')->with(['question' => $question])->with(['answer' => $answer]);
    }
    public function storeAnswer(Request $req, AnswerPostRequest $request, Answer $answer, Question $question, User $user)
    {
        $input = $request['answer'];
        $user_id = $req->user_id;
        $answer_id = $req->question_id;

        $answer->fill($input)->save();
        $answer->users()->sync($user_id);
        $user->answers()->sync($answer_id);
        
        $question->where('id', $answer->question_id)->update(['answers_num' => $answer->where('question_id', $question->id)->count()]);

        //ファイルの保存
        if($req->answer_file){
        
            if(
                //画像ファイル
                $req->answer_file->extension() == 'gif' 
                || $req->answer_file->extension() == 'jpeg' 
                || $req->answer_file->extension() == 'jpg' 
                || $req->answer_file->extension() == 'png'
                || $req->answer_file->extension() == 'bmp'
                || $req->answer_file->extension() == 'svg'
                //音声ファイル
                || $req->answer_file->extension() == 'aac'
                || $req->answer_file->extension() == 'm4a'
                || $req->answer_file->extension() == 'mp1'
                || $req->answer_file->extension() == 'mp2'
                || $req->answer_file->extension() == 'mp3'
                || $req->answer_file->extension() == 'mpg'
                || $req->answer_file->extension() == 'mpeg'
                || $req->answer_file->extension() == 'oga'
                || $req->answer_file->extension() == 'ogg'
                || $req->answer_file->extension() == 'wav'
                || $req->answer_file->extension() == 'wabm'
                //動画ファイル
                //|| $req->answer_file->extension() == 'mp4'
                //|| $req->answer_file->extension() == 'm4v'
                //|| $req->answer_file->extension() == 'ogv'
            )
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
        
            if(
                //画像ファイル
                $req->answer_file->extension() == 'gif' 
                || $req->answer_file->extension() == 'jpeg' 
                || $req->answer_file->extension() == 'jpg' 
                || $req->answer_file->extension() == 'png'
                || $req->answer_file->extension() == 'bmp'
                || $req->answer_file->extension() == 'svg'
                //音声ファイル
                || $req->answer_file->extension() == 'aac'
                || $req->answer_file->extension() == 'm4a'
                || $req->answer_file->extension() == 'mp1'
                || $req->answer_file->extension() == 'mp2'
                || $req->answer_file->extension() == 'mp3'
                || $req->answer_file->extension() == 'mpg'
                || $req->answer_file->extension() == 'mpeg'
                || $req->answer_file->extension() == 'oga'
                || $req->answer_file->extension() == 'ogg'
                || $req->answer_file->extension() == 'wav'
                || $req->answer_file->extension() == 'wabm'
                //動画ファイル
                //|| $req->answer_file->extension() == 'mp4'
                //|| $req->answer_file->extension() == 'm4v'
                //|| $req->answer_file->extension() == 'ogv'
            )
            {
                $req->file('answer_file')->storeAs('public/answer_file', $answer->id.'.'.$req->answer_file->extension());
                $answer->where('id', $answer->id)->update(['file_path' => "/storage/answer_file/".$answer->id.'.'.$req->answer_file->extension()]);
            }
        }        
        
        return redirect('/my_posted_answers');
    }
    public function deleteAnswer(Answer $answer, Question $question)
    {
        $answer->delete();
        return back();
    }
    public function myPostedAnswers(Answer $answer, User $user)
    {
        $user_id = Auth::user()->id;

        return view('answers/my_posted_answers')->with(['user_answers' => $answer->whereHas('users', function ($answer) use ($user_id) {
            $answer->where('user_id', $user_id);
        })->get()]);
    }
}
