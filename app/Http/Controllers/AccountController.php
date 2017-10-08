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
}
