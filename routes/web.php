<?php

use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteAnswerController;
use App\Http\Controllers\VoteQuestionController;
use Illuminate\Support\Facades\Route;

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
require __DIR__.'/auth.php';

Route::get('/', [QuestionController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('questions', QuestionController::class)->except('show');
Route::get('/questions/{slug}', [QuestionController::class, 'show'])->name('questions.show');
Route::resource('questions.answers', AnswerController::class)->except(['index','create','show']);
Route::post('/answers/{answer}/accept', AcceptAnswerController::class)->name('answers.accept');
Route::post('/questions/{question}/favourites', [FavouritesController::class, 'store'])->name('questions.favourite');
Route::delete('/questions/{question}/favourites', [FavouritesController::class, 'destroy'])->name('questions.unfavourite');
Route::post('/questions/{question}/vote', VoteQuestionController::class);
Route::post('/answers/{answer}/vote', VoteAnswerController::class);
