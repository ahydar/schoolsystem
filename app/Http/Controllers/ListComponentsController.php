<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SubjectsRepository;

class ListComponentsController extends Controller
{
    //

    public function GetAllSubjectsWithClasses(SubjectsRepository $subjectsRepo){
        return $subjectsRepo -> GetAllSubjectsWithClasses();
    }

    public function GetSubjectsWithClasses(SubjectsRepository $subjectsRepo,$formsubject_id){
        return $subjectsRepo -> GetSubjectsWithClasses($formsubject_id);
    }

    public function GetAssessmentsForSubject($formsubject_id){
        
    }

    public function GetAssessment($formsubject_id){
        
    }
}
