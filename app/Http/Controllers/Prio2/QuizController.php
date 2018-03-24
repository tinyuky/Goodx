<?php

namespace App\Http\Controllers\Prio2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Answer;
use App\User;

class QuizController extends Controller
{
    //hadle welcome page
    public function welcomeQuiz(Request $request)
    {
        return view('prio2.welcome');
    }

    //random questions and answer function
    //$q = number of question
    //$a = maximum answers of a question
    public function randomQuiz($q, $a)
    {
        $data = array();
        //random question from db
        $questions = DB::table('questions')
                  ->select('id', 'question')
                    ->inRandomOrder()
                      ->limit($q)
                        ->get();
        //random answer of question
        foreach ($questions as $questions) {
            $answer = DB::table('answers')
                  ->select('id', 'answer')
                    ->where('question_id', $questions->id)
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

    //hadle show quiz page
    public function showQuiz(Request $request)
    {
        //If it a new quiz
        if (!$request->session()->has('quiz')) {
            //get array having questions and anwers
            $data = $this->randomQuiz(5, 3);
            //check array
            if (!empty($data)) {
                //save quiz session
                $request->session()->put('quiz', $data);

                return view('prio2.quiz', ['data'=>$data]);
            }
            //array have no data
            else {
                return redirect(route('quiz.welcome'));
            }
        }
        //If it not a new quiz
        else {
            //if have result but not fill name, email when finish-> redirect to result page
            if ($request->session()->has('result')) {
                $this->showResult($request);
            }
            //if no result -> countinute quiz
            else {
                return view('prio2.quiz', ['data'=>$request->session()->get('quiz')]);
            }
        }
    }

    //check quiz function
    public function checkQuiz($data, $request)
    {
        //create result var
        $result = 0;
        //check aswer
        foreach ($data as $row) {
            //get question id
            $ques_id = $row['id'];
            //get user's answer from request
            $user_answer = $request['q'.$ques_id];

            //if it is not a true false question
            if (($user_answer!='TRUE')&&($user_answer!='FALSE')) {
                //get answer from db
                $db_answer = Answer::where('question_id', $ques_id)
                              ->where('correct', '1')
                                ->where('id', $user_answer)
                                  ->first();
                //if correct
                if (isset($db_answer)) {
                    $result++;
                }
            }
            //if it is a true false question
            else {
                //get answer from db
                $db_answer = Answer::where('question_id', $ques_id)
                              ->where('correct', '1')
                                ->where('answer', $user_answer)
                                  ->first();
                //if correct
                if (isset($db_answer)) {
                    $result++;
                }
            }
        }
        //add result session
        $request->session()->put('result', $result);
    }


    //handle submit quiz button
    public function submitQuiz(Request $request)
    {
        //get question from session
        $data = $request->session()->get('quiz');

        //create a condition array to validate input
        $id_arr = [];
        foreach ($data as $row) {
            $id_arr['q'.$row['id']] = 'required';
        }
        //validate input
        $this->validate($request, $id_arr);

        //check quiz
        $this->checkQuiz($data, $request);

        //redirect to result page
        return redirect()->route('quiz.result');
    }

    //handle result page
    public function showResult(Request $request)
    {
        return view('prio2.result');
    }

    //handle finshish button
    public function finishQuiz(Request $request)
    {
        //validate input
        $this->validate($request, [
      'name'=>'required',
      'email'=>'required|email',
    ]);

        //create user by model
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
        return view('prio2.thank', ['users'=>$users,'you'=>$user->id]);
    }
}
