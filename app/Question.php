<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $table = 'questions';
  protected $fillable = [
      'question','explanation','source'
  ];
  public function answers()
    {
        return $this->hasMany('App\Answer','question_id','id');
    }
}
