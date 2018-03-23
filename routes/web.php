<?php

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
Route::prefix('prio1')->namespace('Prio1')->group(function(){
  

});
Route::prefix('prio2')->namespace('Prio2')->group(function(){
  Route::post('ques','QuestionController@import')->name('ques.import');
  Route::get('welcome','QuizController@welcomeQuiz')->name('quiz.welcome');
  Route::get('quiz','QuizController@showQuiz')->name('quiz.show');
  Route::post('quiz','QuizController@submitQuiz')->name('quiz.submit');
  Route::post('finish','QuizController@finishQuiz')->name('quiz.finish');
  Route::get('result','QuizController@showResult')->name('quiz.result');
});
