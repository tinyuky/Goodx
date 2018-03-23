<?php

namespace App\Http\Controllers\Prio1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Answer;
use App\User;

class QuizController extends Controller
{
    function welcome(){
      return view('prio1.index');
    }


    //random questions and answer function
    //$q = number of question
    //$a = maximum answers of a question
    function randomQuiz($q,$a){
      $data = array();
      //random question from db
      $questions = DB::table('questions')
                    ->select('id','question')
                      ->inRandomOrder()
                        ->limit($q)
                          ->get();
      //random answer of question
      foreach ($questions as $questions) {
        $answer = DB::table('answers')
                    ->select('id','answer')
                      ->where('question_id',$questions->id)
                        ->inRandomOrder()
                          ->limit($a)
                            ->get();
        //add question and answer to array
        $data[]=[
          'id'=>$questions->id,
          'question'=>$questions->question,
          'answer'=>$answer,
        ];
      }
      //return array
      return $data;
    }

    function show(Request $request){

        $data = $this->randomQuiz(5,3);

      return response()->json($data);
    }
}
