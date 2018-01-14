<?php

namespace App\Repositories;

use App\Gaurdians;
use DB;
use Auth;
use App\User;

class GaurdiansRepository
{

    public function all(){
      $account_id  = Auth::user() -> account_id;
      $gaurdians = User::leftJoin('gaurdians','users.id','=','learners.user_id')
                    ->leftJoin('userextras','users.id','=','userextras.user_id')
                    ->select('users.*','relationship','learner_user_id',
                    'address','postalCode','nationality','maritalStatus','idNumber','totalFees')
                    ->where([
                      ['users.account_id','=',$account_id],
                      ['usertype_id','=',3]
                    ])
                    ->get();
      return ['gaurdians'=>$gaurdians];
    }

    public function getOne($learner_user_id){
      $account_id  = Auth::user() -> account_id;
      $gaurdians = User::leftJoin('gaurdians','users.id','=','gaurdians.user_id')
                    ->leftJoin('userextras','users.id','=','userextras.user_id')
                    ->select('users.*','relationship','learner_user_id',
                    'address','postalCode','nationality','maritalStatus','idNumber','totalFees')
                    ->where([
                      ['users.account_id','=',$account_id],
                      ['usertype_id','=',3],
                      ['learner_user_id','=',$learner_user_id]
                    ])
                    ->get();
      return $gaurdians;
    }
}
