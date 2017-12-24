<?php

namespace App\Http\Controllers;

use App\Learnerassessment;
use Illuminate\Http\Request;
use App\Assessment;
use Auth;

class LearnerassessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assessment_id)
    {
        //
        $assess = Assessment::join('learnersubjects','assessments.formsubject_id','=','learnersubjects.formsubject_id')
        ->join('learners','learners.id','=','learnersubjects.learner_id')
        ->join('users','users.id','=','learners.user_id')
        ->leftJoin('learnerassessments',function($join){
                $join -> on('learnerassessments.assessment_id','=','assessments.id')
                      -> on('learnerassessments.learner_id','=','learners.id');
        })
        ->where('assessments.id','=',$assessment_id)
        ->select('learnerassessments.id','learners.id as learner_id','assessments.id as assessment_id','assessMark','assessName'
                ,'firstName','lastName','mark','mark as originalMark')
        ->get();

        return $assess;
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
        $account_id = Auth::user()->account_id;
        $assessment_id = $request -> input('0.assessment_id');
        $assessment = Assessment::find($assessment_id);
        $input = $request -> input();
        $learnerassessments = [];
        foreach($input as $item){
            if($item['id'] == null){
                $learnerassessment = new LearnerAssessment;
            }else{
                $learnerassessment = LearnerAssessment::find($item['id']);
            }

            $learnerassessment -> account_id = $account_id;
            $learnerassessment -> mark = $item['mark'];
            $learnerassessment -> assessment_id = $item['assessment_id'];
            $learnerassessment -> learner_id = $item['learner_id'];
            $learnerassessments[] = $learnerassessment;
        }

        $assessment -> learnerassessments() -> saveMany($learnerassessments);

        return $this -> index($assessment_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Learnerassessment  $learnerassessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Learnerassessment $learnerassessment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Learnerassessment  $learnerassessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Learnerassessment $learnerassessment)
    {
        //
    }
}
