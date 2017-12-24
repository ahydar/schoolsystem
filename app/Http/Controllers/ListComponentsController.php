<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SubjectsRepository;
use App\Repositories\AssessmentsRepository;

class ListComponentsController extends Controller
{
    //

    public function GetAllSubjectsWithClasses(SubjectsRepository $subjectsRepo){
        return $subjectsRepo -> GetAllSubjectsWithClasses();
    }

    public function GetSubjectsWithClasses(SubjectsRepository $subjectsRepo,$formsubject_id){
        return $subjectsRepo -> GetSubjectsWithClasses($formsubject_id);
    }

    public function GetAllAssessmentsOfSubject(AssessmentsRepository $assessRepo,$formsubject_id){
        return $assessRepo -> GetAllAssessmentsOfSubject($formsubject_id);
    }

    public function GetAssessment($formsubject_id){
        
    }
}
