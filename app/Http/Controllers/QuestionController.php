<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use App\Http\Requests\QuestionPostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionController extends Controller
{
    public function home(Question $question, Answer $answer, Request $request)
    {
        //検索機能
        $range = $request->range;
        $keyword = $request->input('keyword');
        $query = Question::query();
        
        if(!empty($keyword)) {
            
            if($range == 'all') {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%")
                ->orWhere('user_name', 'LIKE', "%{$keyword}%");
            } elseif ($range == 'title') {
                $query->where('title', 'LIKE', "%{$keyword}%");
            } elseif ($range == 'body') {
                $query->where('body', 'LIKE', "%{$keyword}%");
            } elseif ($range == 'user_name') {
                $query->where('user_name', 'LIKE', "%{$keyword}%");
            } else {
                $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%")
                ->orWhere('user_name', 'LIKE', "%{$keyword}%");
            }
            
        }
            
        //並べ替え機能
        $select = $request->sort;
        
        if($select == 'old'){
            $questions = $query->orderBy('created_at', 'asc')->get();
        } elseif($select == 'new') {
            $questions = $query->orderBy('created_at', 'desc')->get();
        } else {
            $questions = $query->get();
        }
        
        $questions = $query->get();

        return view('questions/home', compact('questions', 'answer', 'keyword'));
        
        // return view('questions/home')->with(['questions' => $question->order($request->sort)])->with(['answer' => $answer])->with(['keyword' => $keyword]);
    }
    public function postQuestion(Question $question)
    {
        return view('questions/post_question')->with(['question' => $question]);
    }
    public function storeQuestion(Request $req, QuestionPostRequest $request, Question $question, User $user)
    {
        $input = $request['question'];
        $user_id = $req->user_id;
        $question_id = $req->question_id;
        
        $question->fill($input)->save();
        $question->users()->sync($user_id);
        $user->questions()->sync($question_id);

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
        
        return redirect('/');
    }
    public function editQuestion(Question $question)
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
        
        return redirect('/my_posted_questions');
    }
    public function deleteQuestion(Question $question)
    {
        $question->delete();
        return back();
    }
    public function myPostedQuestions(Question $question, User $user, Request $request)
    {
        $user_id = Auth::user()->id;
        
        //並べ替え機能
        // $select = $request->sort;
        
        // if($select == 'old'){
        //     $question->whereHas('users', function ($question) use ($user_id) { $question->where('user_id', $user_id); })->orderBy('created_at', 'asc');
        // } elseif($select == 'new') {
        //     $question->whereHas('users', function ($question) use ($user_id) { $question->where('user_id', $user_id); })->orderBy('created_at', 'desc');
        // } else {
        //     $question->all()->whereHas('users', function ($question) use ($user_id) { $question->where('user_id', $user_id); });
        // }
        
        // return view('questions/my_posted_questions')->with(['user_questions' => $question->get()]);
        
        return view('questions/my_posted_questions')->with(['user_questions' => $question->whereHas('users', function ($question) use ($user_id) {
            $question->where('user_id', $user_id);
        })->orderBy('created_at', 'desc')->get()]);
    }
}
