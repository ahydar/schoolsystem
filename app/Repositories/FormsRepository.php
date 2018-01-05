<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Auth;
use App\Form;

class FormsRepository
{
    //
    public function GetAllClasses(){
        $forms = Form::all();

        $firstItem = ["id" => 0,"formName" => "Select a class"];
        return $forms -> prepend($firstItem);
    }
}
