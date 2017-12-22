<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    //
    public function formsubjects(){
        return $this -> hasMany('App\Formsubject');
    }
}
