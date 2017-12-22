<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    public function formsubjects(){
        return $this -> hasMany('App\Formsubject');
    }
}
