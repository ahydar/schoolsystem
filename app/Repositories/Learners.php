<?php

namespace App\Repositories;

use App\Learner;
use DB;
use Auth;
use App\User;

class Learners
{
    public function all(){
      $account_id  = Auth::user() -> account_id;
      $learners = User::leftJoin('learners','users.id','=','learners.user_id')
                    ->leftJoin('forms','forms.id','=','learners.form_id')
                    ->select('users.*','yearsInPhase','learnerNumber','formName','form_id')
                    ->where([
                      ['users.account_id','=',$account_id],
                      ['usertype_id','=',2]
                    ])
                    ->get();
      return ['learners'=>$learners];
    }


    public function allWithGaurdians(){
      $account_id  = Auth::user() -> account_id;
      $learners = User::leftJoin('learners','users.id','=','learners.user_id')
                    ->leftJoin('userextras','users.id','=','userextras.user_id')
                    ->leftJoin('forms','forms.id','=','learners.form_id')
                    ->select('users.*','yearsInPhase','learnerNumber','formName','form_id',
                    'address','postalCode','nationality','maritalStatus','idNumber','totalFees')
                    ->where([
                      ['users.account_id','=',$account_id],
                      ['usertype_id','=',2]
                    ])
                    ->get();
      return ['learners'=>$learners];
    }
}
