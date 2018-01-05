<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SubjectsRepository;
use App\Repositories\AssessmentsRepository;
use App\Repositories\FormsRepository;

class ListComponentsController extends Controller
{
    //

    public function GetAllSubjectsWithClasses(SubjectsRepository $subjectsRepo){
        return $subjectsRepo -> GetAllSubjectsWithClasses();
    }

    public function GetSubjectsWithClassesForEducator(SubjectsRepository $subjectsRepo){
        return $subjectsRepo -> GetSubjectsWithClassesForEducator();
    }

    public function GetAllAssessmentsOfSubject(AssessmentsRepository $assessRepo,$formsubject_id){
        return $assessRepo -> GetAllAssessmentsOfSubject($formsubject_id);
    }

    public function GetAssessment($formsubject_id){
        
    }

    public function GetAllClasses(FormsRepository $formRepo){
        return $formRepo -> GetAllClasses();
    }
}
