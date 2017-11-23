<?php

namespace App\Http\Controllers;

use App\Formsubject;
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
        $this -> validate(request(),[
            'form_id' => 'required',
            'subject_id' => 'required',
        ]);

        $form_id = request('form_id');
        $account_id = DB::table('forms')->where('id',$form_id)->value('account_id');
        $classSubject = new Formsubject;

        $classSubject -> form_id = request('form_id');
        $classSubject -> subject_id = request('subject_id');
        $classSubject -> account_id = $account_id;

        $classSubject ->save();

        return $this -> index();
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
