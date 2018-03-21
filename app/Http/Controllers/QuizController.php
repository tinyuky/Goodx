<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    function welcome(){
      return view('prio2.welcome');
    }

    function show(){
      $data = array();
      //get 5 random question from db
      $questions = DB::table('questions')
                    ->select('id','question')
                      ->inRandomOrder()
                        ->limit(5)
                          ->get();
      // get random answer from the question
      foreach ($questions as $questions) {
        $answer = DB::table('answers')
                    ->select('id','answer')
                      ->where('question_id',$questions->id)
                        ->inRandomOrder()
                          ->limit(3)
                            ->get();
        $data[]=[
          'question'=>$questions,
          'ans'=>$answer,
        ];
      }

      return view('prio2.quiz',['data'=>$data]);
    }
}
