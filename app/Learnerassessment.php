<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learnerassessment extends Model
{
    //
    public function assessment(){
        return $this->belongsTo('App\Assessment');
    }
}
