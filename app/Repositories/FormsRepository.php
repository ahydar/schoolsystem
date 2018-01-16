<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Auth;
use App\Form;

class FormsRepository
{
    //
    public function GetAllClasses(){
        $account_id = Auth::user() -> account_id;
        $forms = Form::where('account_id','=',$account_id) -> get();

        $firstItem = ["id" => 0,"formName" => "Select a class"];
        return $forms -> prepend($firstItem);
    }
}
