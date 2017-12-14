<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learnersubject extends Model
{
    //
    public function learner(){
        return $this->belongsTo('App\Learner');
    }
}
