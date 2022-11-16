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
Route::post('/home', [QuestionController::class, 'storeQuestion']);

Route::get('/{question}/all_answers', [AnswerController::class, 'allAnswers']);

Route::get('/{question}/post_answer', [AnswerController::class, 'postAnswer']);
Route::post('/{question}/all_answers/store', [AnswerController::class, 'storeAnswer']);

Route::get('/questions/{question}/edit_question', [QuestionController::class, 'editQuestion']);
Route::put('/questions/{question}/delete_file', [QuestionController::class, 'deleteFile']);
Route::put('/questions/{question}', [QuestionController::class, 'questionUpdate']);

Route::get('/questions/{question}/answers/{answer}/edit_answer', [AnswerController::class, 'editAnswer']);

Route::delete('/home/{question}', [QuestionController::class, 'deleteQuestion']);
Route::delete('/{question}/all_answers/{answer}', [AnswerController::class, 'deleteAnswer']);

Route::get('/my_posted_questions', [QuestionController::class, 'myPostedQuestions']);
Route::get('/my_posted_answers', [AnswerController::class, 'myPostedAnswers']);