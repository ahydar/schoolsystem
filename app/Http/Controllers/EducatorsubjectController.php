<?php

namespace App\Http\Controllers;

use App\Educatorsubject;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;

class EducatorsubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //
        $account_id = Auth::user() -> account_id;
        $subjects = DB::table('subjects')
                    ->join('formsubjects','subjects.id','=','formsubjects.subject_id')
                    ->join('forms','formsubjects.form_id','=','forms.id')
                    ->where('formsubjects.account_id','=',$account_id)
                    ->select('formsubjects.*','subjectName','formName')
                    ->get();

        $user = User::with('educator.educatorsubjects')
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Educatorsubject  $educatorsubject
     * @return \Illuminate\Http\Response
     */
    public function show(Educatorsubject $educatorsubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Educatorsubject  $educatorsubject
     * @return \Illuminate\Http\Response
     */
    public function edit(Educatorsubject $educatorsubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Educatorsubject  $educatorsubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Educatorsubject $educatorsubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Educatorsubject  $educatorsubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educatorsubject $educatorsubject)
    {
        //
    }
}
