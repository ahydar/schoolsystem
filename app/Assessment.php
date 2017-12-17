<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //
    public function educatorsubject(){
        return $this -> belongsTo('App\Educatorsubject');
    }
}
