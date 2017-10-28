<?php

namespace App\Http\Controllers;

use App\FormSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $classSubjects = DB::table('formsubjects')
                              -> join('accounts', 'accounts.id','=','formsubjects.account_id')
                              -> join('forms','forms.id','=','formsubjects.form_id')
                              -> join('subjects','subjects.id','=','formsubjects.subject_id')
                              ->select('formsubjects.*','formName','subjectName','accountName')
                              -> get();
          $classes = DB::table('forms')
                              -> join('accounts', 'accounts.id','=','forms.account_id')
                              ->select('forms.*','accountName')
                              -> get();

          $subjects = DB::table('subjects')
                              -> join('accounts', 'accounts.id','=','subjects.account_id')
                              ->select('subjects.*','accountName')
                              -> get();

          return ['classSubjects' => $classSubjects,'classes' => $classes,'subjects'=>$subjects];
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
     * @param  \App\FormSubject  $formSubject
     * @return \Illuminate\Http\Response
     */
    public function show(FormSubject $formSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormSubject  $formSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(FormSubject $formSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormSubject  $formSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormSubject $formSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormSubject  $formSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormSubject $formSubject)
    {
        //
    }
}
