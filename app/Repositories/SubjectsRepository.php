<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Auth;
use App\Subject;
use App\Formsubject;
use App\Form;

class SubjectsRepository
{
    //
    public function GetAllSubjectsWithClasses(){
        $formsubjects = Subject::join('formsubjects','formsubjects.subject_id','=','subjects.id')
                                ->join('forms','forms.id','=','formsubjects.form_id')
                                ->select('formsubjects.id','subjectName','formName')
                                ->get();

        $firstItem = ["id" => 0,"subjectName" => "Select a subject","formName" => ""];
        return $formsubjects -> prepend($firstItem);
    }

    public function GetSubjectsWithClasses($formsubject_id){
        $formsubjects = Formsubject::find($formsubject_id);
        
        $formsubjects -> load('subject','form');

        return $formsubjects;
    }
}
