<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Answer;
use App\User;

class QuizController extends Controller
{
    //hadle welcome page
    function welcomeQuiz(Request $request){
      // $request->session()->forget('quiz');
      // $request->session()->forget('result');
      return view('prio2.welcome');
    }

    //random questions and answer
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
          'question'=>$questions,
          'ans'=>$answer,
        ];
      }
      //return array
      return $data;
    }

    //hadle show quiz page
    function showQuiz(Request $request){
      //If it a new quiz
      if(!$request->session()->has('quiz')){
        //get array having questions and anwers
        $data = $this->randomQuiz(5,3);
        //check array
        if(!empty($data)){
          //save quiz session
          $request->session()->put('quiz',$data);

          return view('prio2.quiz',['data'=>$data]);
        }
        //array have no data
        else{
          return redirect(route('quiz.welcome'));
        }
      }
      //If it not a new quiz
      else{
        //if have result but not fill name, email when finish-> redirect to result page
        if($request->session()->has('result')){
          $this->showResult($request);
        }
        //if no result -> countinute quiz
        else{
          return view('prio2.quiz',['data'=>$request->session()->get('quiz')]);
        }

      }
    }

    //handle submit quiz button
    function submitQuiz(Request $request){
      //get question from session
      $data = $request->session()->get('quiz');

      //create a condition array to validate input
      $id_arr = [];
      for ($i=0; $i < count($data) ; $i++) {
          $id_arr['q'.$data[$i]['question']->id] = 'required';
      }
      $this->validate($request,$id_arr);

      //create result var
      $result = 0;
      //check aswer
      for ($i=0; $i < count($data) ; $i++) {
        //get question id
        $ques_id = $data[$i]['question']->id;
        //get user's answer from request
        $user_answer = $request['q'.$ques_id];

        //if it is question with 3 answers
        if(($user_answer!='TRUE')&&($user_answer!='FALSE')){
          //get answer from db
          $db_answer = Answer::where('question_id',$ques_id)
                        ->where('correct','1')
                          ->first();
          //if correct
          if($user_answer == $db_answer->id){
            $result++;
          }
        }
        //if it is a true false question
        else{
          //get answer from db
          $db_answer = Answer::where('question_id',$ques_id)
                        ->where('correct','1')
                          ->first();
          //if correct
          if($user_answer == $db_answer->answer){
            $result++;
          }
        }
      }
      //add result session
      $request->session()->put('result',$result);
      //redirect to result page
      return redirect()->route('quiz.result');
    }

    //handle result page
    function showResult(Request $request){
      return view('prio2.result');
    }

    //handle create user
    function finishQuiz(Request $request){
      //validate input
      $this->validate($request,[
        'name'=>'required',
        'email'=>'required|email',
      ]);

      //create user bye moddel
      $user = User::create(['name'=>$request['name']
                                    ,'email'=>$request['email']
                                      ,'score'=>$request->session()->get('result')]);

      //delete session
      $request->session()->forget('quiz');
      $request->session()->forget('result');

      //get users
      $users = DB::table('users')
                ->orderBy('score', 'desc')
                ->get();
      //redirect to thank page with top people and your rank
      return view('prio2.thank',['users'=>$users,'you'=>$user->id]);
    }
}
