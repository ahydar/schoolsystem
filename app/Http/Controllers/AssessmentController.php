<?php

namespace App\Http\Controllers;

use App\Assessment;
use Illuminate\Http\Request;
use Auth;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user() -> id;
        //$user = 'App\User'::with('educator.educatorsubjects.assessments')->find(1);
        $user = 'App\User'::with(['educator.educatorsubjects' => function ($query) {
            $query->join('formsubjects','formsubjects.id','=','educatorsubjects.formsubject_id')
                  ->join('subjects','subjects.id','=','formsubjects.subject_id')
                  ->select('educatorsubjects.*','subjectName')
                  ->with('assessments');
        }])->find($user_id);

        $subjects = $user -> educator -> educatorsubjects;  
        return $subjects;
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
    public function store(Request $request,$formsubject_id)
    {
        //
        $account_id = Auth::user() -> account_id;
        $this -> validate(request(),[
            'assessName' => 'required',
            'assessTerm' => 'required|numeric',
            'assessMark' => 'required|numeric',
            'assessTermPercentage' => 'required|numeric|max:100',
            'assessFinalPercentage' => 'required|numeric|max:100',
        ]);
        
        $assess = New Assessment;

        $assess -> assessName = request('assessName');
        $assess -> assessTerm = request('assessTerm');
        $assess -> assessMark = request('assessMark');
        $assess -> assessTermPercentage = request('assessTermPercentage');
        $assess -> assessFinalPercentage = request('assessFinalPercentage');
        $assess -> formsubject_id = $formsubject_id;
        $assess -> account_id = $account_id;

        $assess -> save();

        return $assess;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function show(Assessment $assessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assessment $assessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$formsubject_id)
    {
        //
        $this -> validate(request(),[
            'assessName' => 'required',
            'assessTerm' => 'required|numeric',
            'assessMark' => 'required|numeric',
            'assessTermPercentage' => 'required|numeric|max:100',
            'assessFinalPercentage' => 'required|numeric|max:100'
        ]);

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assessment $assessment)
    {
        //
    }
}
