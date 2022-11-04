<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;

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

// Route::get('/home',[QuestionController::class, 'index']);
Route::get('/home', [TipController::class, 'home']);
Route::get('/post_question', [TipController::class, 'postQuestion']);
Route::get('/my_posted_questions', [TipController::class, 'myPostedQuestions']);
Route::get('/post_answer', [TipController::class, 'postAnswer']);
Route::get('/all_answers', [TipController::class, 'allAnswers']);
Route::get('/my_posted_answers', [TipController::class, 'myPostedAnswers']);