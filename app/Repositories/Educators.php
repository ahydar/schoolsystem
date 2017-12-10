<?php

namespace App\Repositories;

use App\Educator;
use DB;
use Auth;
use App\User;

class Educators
{
    public function all(){
      $account_id  = Auth::user() -> account_id;
      $educators =
                  User::leftJoin('educators','users.id','=','educators.user_id')
                    ->leftJoin('educatorforms','educators.id','=','educatorforms.educator_id')
                    ->leftJoin('forms','forms.id','=','educatorforms.form_id')
                    ->select('users.*','title','initial','formName','form_id')
                    ->where([
                      ['users.account_id','=',$account_id],
                      ['usertype_id','=',1]
                    ])
                    ->get();
      return ['educators'=>$educators];
    }
}
