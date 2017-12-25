<?php

namespace App\Http\Controllers;

use App\Learnermark;
use Illuminate\Http\Request;
use Auth;
use App\FormSubject;

class LearnermarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($formsubject_id)
    {
        //
        $learnermarks = FormSubject::join('learnersubjects','formsubjects.id','=','learnersubjects.formsubject_id')
        ->join('learners','learners.id','=','learnersubjects.learner_id')
        ->join('users','users.id','=','learners.user_id')
        ->leftJoin('learnermarks',function($join){
                $join -> on('learnermarks.formsubject_id','=','formsubjects.id')
                      -> on('learnermarks.learner_id','=','learners.id');
        })
        ->where('formsubjects.id','=',$formsubject_id)
        ->select('learnermarks.id','learners.id as learner_id','formsubjects.id as formsubject_id',
                'firstName','lastName','mark1','mark1','mark3','mark4','final')
        ->get();

        return $learnermarks;

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
     * @param  \App\Learnermark  $learnermark
     * @return \Illuminate\Http\Response
     */
    public function show(Learnermark $learnermark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Learnermark  $learnermark
     * @return \Illuminate\Http\Response
     */
    public function edit(Learnermark $learnermark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Learnermark  $learnermark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Learnermark $learnermark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Learnermark  $learnermark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Learnermark $learnermark)
    {
        //
    }
}
