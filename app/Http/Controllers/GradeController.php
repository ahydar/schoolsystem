<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = DB::table('accounts')
                  ->join('grades','grades.account_id','=','accounts.id')
                  ->where('grades.account_id','=', Auth::user()->account_id)
                  ->get();
        return ['grades' => $grades];
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
      $this -> validate(request(),[
          'gradeName' => 'required'
      ]);

      $grade = new Grade;

      $grade -> gradeName = request('gradeName');
      $grade -> account_id = Auth::user()->account_id;

      $grade ->save();

      return $this -> index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this -> validate(request(),[
          'gradeName' => 'required'
      ]);

      $grade = Grade::find($id);

      $grade -> gradeName = request('gradeName');
      $grade -> account_id = Auth::user()->account_id;
      $grade -> save();

      return $this -> index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $grade = Grade::find($id);
      $grade -> delete();

      return $this -> index();
    }
}
