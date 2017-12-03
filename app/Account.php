<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public funnction users(){
          return $this->hasMany('App\User');
    }
}
