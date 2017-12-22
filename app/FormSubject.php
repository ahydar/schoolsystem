<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formsubject extends Model
{
    //
    public function subject(){
        return $this -> belongsTo('App\Subject');
    }

    public function form(){
        return $this -> belongsTo('App\Form');
    }
}
