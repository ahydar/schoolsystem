<?php

namespace App\Http\Controllers;

use App\Learnerassessmentmark;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Learner;
use App\Assessment;

class LearnerassessmentmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $learners = User::join('learners','learners.user_id','=','users.id')
                    -> join('learnersubjects','learners.id','=','learnersubjects.learner_id')
                    -> join('assessments','assessments.formsubject_id','=','learnersubjects.formsubject_id')
                    ->leftJoin('learnerassessments',function($join){
                        $join -> on('learnerassessments.assessment_id','=','assessments.id')
                              -> on('learnerassessments.learner_id','=','learners.id');
                    })
                    -> where('assessments.formsubject_id','=',1)
                    ->select('learners.id as learner_id','assessments.id as assessment_id','assessments.formsubject_id',
                    'assessMark','assessName','assessTermPercentage','assessFinalPercentage','assessTerm'
                    ,'firstName','lastName','learnerNumber','mark','mark as originalMark')
                    -> get();
        
        //$this::getPercMark($learners);

        $this::getTermPerc($learners);

        $this::getFinalPerc($learners);
        
        //$grouped = $learners -> groupBy('firstName');

        return $learners -> groupBy('firstName');
    }

    public static function getPercMark($learners){

        foreach ($learners as $key => $item) {
            if($item -> mark != null){
                $item['percMark'] = ($item -> mark / $item -> assessMark) * 100;
            }else{
                $item['percMark'] = null;
            }
        }
    }

    public static function getTermPerc($learners){
        $termArray = [];
        foreach ($learners as $key => $item) {
            $newKey = "formsub".$item['formsubject_id'].'term'.$item['assessTerm'].'learner'.$item['learner_id'];
            $check = isset($termArray[$newKey]);
            if($check){
                $termArray[$newKey]['mark'] += ($item['mark'] / $item['assessMark']) * $item['assessTermPercentage'];
            }else{
                $termArray[$newKey]['mark'] = ($item['mark'] / $item['assessMark']) * $item['assessTermPercentage'];
                $termArray[$newKey]['firstName'] = $item['firstName'];
                $termArray[$newKey]['Term'] = $item['assessTerm'];
            }
        }

        //$learners -> push($termArray);
        foreach ($termArray as $key => $item) {
            $learners -> push($item);
        }
    }

    public static function getFinalPerc($learners){
        $termArray = [];
        foreach ($learners as $key => $item) {
            if(isset($item['formsubject_id'])){
                $newKey = "formsub".$item['formsubject_id'].'learner'.$item['learner_id'];
                $check = isset($termArray[$newKey]);
                if($check){
                    $termArray[$newKey]['mark'] += ($item['mark'] / $item['assessMark']) * $item['assessFinalPercentage'];
                }else{
                    $termArray[$newKey]['mark'] = ($item['mark'] / $item['assessMark']) * $item['assessFinalPercentage'];
                    $termArray[$newKey]['firstName'] = $item['firstName'];
                    $termArray[$newKey]['Final'] = 'final';
                }
            }
        }
        
        //$learners -> push($termArray);
        foreach ($termArray as $key => $item) {
            $learners -> push($item);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Learnerassessmentmark  $learnerassessmentmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Learnerassessmentmark $learnerassessmentmark)
    {
        //
    }

}
