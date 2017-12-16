<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educatorsubject extends Model
{
    //
    public function educator(){
        return $this -> belongsTo('App\Educator');
      }
}
