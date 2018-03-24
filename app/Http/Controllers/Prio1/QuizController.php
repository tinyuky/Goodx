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
    //handle welcome page
    public function welcome()
    {
        return view('prio1.index');
    }


    //function random questions and answer
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


    //Quiz API
    public function show(Request $request)
    {
        $data = $this->randomQuiz(5, 3);

        return response()->json($data);
    }

    //Result API
    public function check(Request $request)
    {
        $result=0;
        //Quiz has 5 questions so use for with i < 5
        for ($i=0;$i<5;$i++) {

            //normal id: "123" and true-false id: "123-TRUE"
            // explode the input to get id like id in database
            $id = explode("-", $request->request->get($i));

            //if it is a normal id
            if (count($id)==1) {
                //select from db
                $check = Answer::where('id', $request->request->get($i))
                          ->where('correct', '1')
                            ->first();

                if (isset($check)) {
                    $result++;
                }
                //if it is a true-false id
            } else {
                //select from db
                $check = Answer::where('id', $id[0])
                          ->where('correct', '1')
                            ->where('answer', $id[1])
                              ->first();
                if (isset($check)) {
                    $result++;
                }
            }
        }

        return response()->json(['result'=>$result]);
    }

    //new User function
    public function createUser(Request $request)
    {
        $user = User::create($request->all());
    }

    //get all User API
    public function getUser()
    {
        return User::orderBy('score', 'desc')->get();
    }

    //get lastest user API
    public function getNewUser()
    {
        return User::latest()->first();
    }
}
