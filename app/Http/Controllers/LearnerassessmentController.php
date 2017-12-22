<?php

namespace App\Http\Controllers;

use App\Learnerassessment;
use Illuminate\Http\Request;
use App\Assessment;

class LearnerassessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $assess = Assessment::join('learnersubjects','assessments.formsubject_id','=','learnersubjects.formsubject_id')
        ->join('learners','learners.id','=','learnersubjects.learner_id')
        ->join('users','users.id','=','learners.user_id')
        ->leftJoin('learnerassessments','learnerassessments.assessment_id','=','assessments.id')
        ->select('assessments.*','userName')
        ->find(2);

        return $assess;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\Learnerassessment  $learnerassessment
     * @return \Illuminate\Http\Response
     */
    public function show(Learnerassessment $learnerassessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Learnerassessment  $learnerassessment
     * @return \Illuminate\Http\Response
     */
    public function edit(Learnerassessment $learnerassessment)
    {
        //
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
