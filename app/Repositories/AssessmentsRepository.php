<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Auth;
use App\Subject;
use App\Formsubject;
use App\Form;
use App\Assessment;

class AssessmentsRepository
{
    //
    public function GetAllAssessmentsOfSubject($formsubject_id){
        $assessments = Subject::join('formsubjects','formsubjects.subject_id','=','subjects.id')
                                ->join('forms','forms.id','=','formsubjects.form_id')
                                ->join('assessments','assessments.formsubject_id','=','formsubjects.id')
                                ->select('assessments.id','subjectName','formName','assessName')
                                ->where('assessments.formsubject_id','=',$formsubject_id)
                                ->get();

        if($assessments -> isNotEmpty()){
            $firstItem = ["id" => 0,"assessName" => "Select an assessment"];
            $assessments -> prepend($firstItem);
        }
        return $assessments;
    }

    public function GetSubjectsWithClasses($formsubject_id){
        $formsubjects = Formsubject::find($formsubject_id);
        
        $formsubjects -> load('subject','form');

        return $formsubjects;
    }
}
