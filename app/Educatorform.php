<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educatorform extends Model
{

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  public function educator(){
    return $this -> belongsTo('App\Educator');
  }
}
