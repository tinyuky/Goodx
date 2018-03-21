<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Answer;
use App\Question;

class QuestionController extends Controller
{
    //show import page
    public function show()
    {
        return view('prio2.catelog.catelogpage');
    }

    //handle json file
    public function import(Request $request)
    {
        //condition when fill url
        $condition=[
          'url' => 'required',
        ];
        //message for error
        $messages = [
          'required' => 'You must fill the json file url',
        ];
        //validate
        $this->validate($request, $condition,$messages);

        //delete old data in database
        DB::table('answers')->delete();
        DB::table('questions')->delete();

        //get content json file from url
        $data_json  = file_get_contents($request->url);
        $data = json_decode($data_json,true);

        //create data rows
        for($i=1;$i<count($data);$i++){
          //questions table
          $question = Question::create(['question'=>$data[$i]['question']
                                        ,'explanation'=>$data[$i]['explanation']
                                          ,'source'=>$data[$i]['source']]);
          //answer table
          //if this is a 3 answers question
          if(isset($data[$i]['answers'])){
            foreach($data[$i]['answers'] as $as){
              if($data[$i]['answer']== $as){
                $answer = Answer::create(['question_id'=>$question->id
                                              ,'answer'=>$as
                                                ,'correct'=>1]);
              }
              else{
                $answer = Answer::create(['question_id'=>$question->id
                                              ,'answer'=>$as
                                                ,'correct'=>0]);
              }

            }
          }
          //if this is a true false question
          else{
            $answer = Answer::create(['question_id'=>$question->id
                                          ,'answer'=>$data[$i]['answer']
                                            ,'correct'=>1]);
          }


        }

        //return welcome page after creating data rows
        return route('quiz.welcome');

    }


}
