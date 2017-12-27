<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    public function user(){
      return $this->belongsTo(User::class);
    }

    public function learnersubjects(){
      return $this->hasMany('App\Learnersubject');
    }

    public function learnerassessments(){
      return $this->hasMany('App\Learnerassessment');
    }
}
