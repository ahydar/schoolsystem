<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subjects = DB::table('accounts')
                      ->join('subjects','subjects.account_id','=','accounts.id')
                      ->where('subjects.account_id','=', Auth::user()->account_id)
                      ->get();
      return ['subjects' => $subjects];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this -> validate(request(),[
          'subjectName' => 'required'
      ]);

      $subject = new Subject;

      $subject -> subjectName = request('subjectName');
      $subject -> account_id = Auth::user()->account_id;

      $subject ->save();

      return $this -> index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this -> validate(request(),[
          'subjectName' => 'required'
      ]);

      $subject = Subject::find($id);

      $subject -> subjectName = request('subjectName');
      $subject -> account_id = Auth::user()->account_id;
      $subject -> save();

      return $this -> index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $subject = Subject::find($id);
      $subject -> delete();

      return $this -> index();
    }
}
