<?php

namespace App\Http\Controllers;

use App\Learnersubject;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;

class LearnersubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id,$form_id)
    {
        $account_id = Auth::user() -> account_id;
        $subjects = DB::table('subjects')
                    ->join('formsubjects','subjects.id','=','formsubjects.subject_id')
                    ->where([
                        ['form_id','=',$form_id],
                        ['formsubjects.account_id','=',$account_id]
                    ])
                    ->select('formsubjects.*','subjectName')
                    ->get();

        $user = User::with('learner.learnersubjects')
                            ->find($user_id);

        
        return ['user'=>$user,'subjects'=>$subjects];

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
        $user_id = $request -> input('0.user_id');

        $form_id = $request -> input('0.form_id');

        $input = $request -> input();
        
        $learnersubjects = [];
        foreach($input as $item){
            $subject = new Learnersubject;
            $subject -> formsubject_id = $item['id'];
            $learnersubjects[] = $subject;
        }

        $user = User::with('learner')->find($user_id);

        $learner = $user -> learner;

        $learner -> learnersubjects() -> saveMany($learnersubjects);

        return  $this -> index($user_id,$form_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Learnersubject  $learnersubject
     * @return \Illuminate\Http\Response
     * 
     */
    public function show(Learnersubject $learnersubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Learnersubject  $learnersubject
     * @return \Illuminate\Http\Response
     */
    public function edit(Learnersubject $learnersubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Learnersubject  $learnersubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Learnersubject $learnersubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Learnersubject  $learnersubject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$user_id,$form_id)
    {
        $learnersubject = Learnersubject::find($id);

       $learnersubject -> delete();

       return  $this -> index($user_id,$form_id);
    }
}
