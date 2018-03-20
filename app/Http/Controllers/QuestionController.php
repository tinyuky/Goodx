<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Answer;
use App\Question;

class QuestionController extends Controller
{

    public function show()
    {
        return view('import.importpage');
    }


    public function import(Request $request)
    {
        $valid=[
          'url' => 'required',
        ];
        $messages = [
          'required' => 'You must fill the json file url',
        ];
        $this->validate($request, $valid,$messages);

        $data_json  = file_get_contents($request->url);
        $data = json_decode($data_json,true);

        for($i=1;$i<count($data);$i++){
          $question = Question::create(['question'=>$data[$i]['question']
                                        ,'explanation'=>$data[$i]['explanation']
                                          ,'source'=>$data[$i]['source']]);
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
          else{
            $answer = Answer::create(['question_id'=>$question->id
                                          ,'answer'=>$data[$i]['answer']
                                            ,'correct'=>1]);
          }


        }

        return view('import.thankpage');
    }


}
