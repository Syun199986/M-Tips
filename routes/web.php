<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [QuestionController::class, 'home']);
Route::get('/post_question', [QuestionController::class, 'postQuestion']);
Route::get('/my_posted_questions', [QuestionController::class, 'myPostedQuestions']);
Route::get('/post_answer', [AnswerController::class, 'postAnswer']);
Route::get('/all_answers', [AnswerController::class, 'allAnswers']);
Route::get('/my_posted_answers', [AnswerController::class, 'myPostedAnswers']);
Route::get('/edit_question', [QuestionController::class, 'editQuestion']);
Route::get('/edit_answer', [AnswerController::class, 'editAnswer']);