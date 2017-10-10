<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    //
    function getAccounts(){
        $accounts = Account::all();
        return $accounts;
    }

    function store(){

      $this -> validate(request(),[
          'accountName' => 'required',
          'accountType' => 'required'
      ]);

      return request()-> all();
    }
}
