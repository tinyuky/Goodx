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
Route::prefix('prio1')->group(function(){

});
Route::prefix('prio2')->group(function(){
  Route::post('ques','QuestionController@import')->name('ques.import');
  Route::get('welcome','QuizController@welcome')->name('quiz.welcome');
  Route::get('quiz','QuizController@show')->name('quiz.show');
  Route::post('quiz','QuizController@submit')->name('quiz.submit');
});
