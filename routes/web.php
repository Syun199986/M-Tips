<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', [QuestionController::class, 'home']);

Route::group(['middleware' => ['auth']], function(){
    Route::get('/post_question', [QuestionController::class, 'postQuestion']);
    Route::post('/home', [QuestionController::class, 'storeQuestion']);
    
    Route::get('/{question}/all_answers', [AnswerController::class, 'allAnswers']);
    
    Route::get('/{question}/post_answer', [AnswerController::class, 'postAnswer']);
    Route::post('/{question}/all_answers/store', [AnswerController::class, 'storeAnswer']);
    
    Route::get('/questions/{question}/edit_question', [QuestionController::class, 'editQuestion']);
    Route::put('/questions/{question}/delete_file', [QuestionController::class, 'deleteFile']);
    Route::put('/questions/{question}', [QuestionController::class, 'questionUpdate']);
    
    Route::get('/answers/{answer}/edit_answer/', [AnswerController::class, 'editAnswer']);
    Route::put('/answers/{answer}/delete_file', [AnswerController::class, 'deleteFile']);
    Route::put('/answers/{answer}/answer_put', [AnswerController::class, 'answerUpdate']);
    
    Route::delete('/home/{question}', [QuestionController::class, 'deleteQuestion']);
    Route::delete('/answers/{answer}', [AnswerController::class, 'deleteAnswer']);
    
    Route::get('/my_posted_questions', [QuestionController::class, 'myPostedQuestions']);
    Route::get('/my_posted_answers', [AnswerController::class, 'myPostedAnswers']);
});