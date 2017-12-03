<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FormController extends Controller
{

  public function __construct(){
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id  = Auth::user() -> account_id;
        $classes = DB::table('accounts')
                      ->join('grades','accounts.id','=','grades.account_id')
                      ->join('forms','grades.id','=','forms.grade_id')
                      ->select('forms.*','gradeName','accountName')
                      ->where('forms.account_id','=',$account_id)
                      ->get();
        $grades = DB::table('grades')
                      ->join('accounts','accounts.id','=','grades.account_id')
                      ->select('grades.*','accountName')
                      ->where('grades.account_id','=',$account_id)
                      ->get();
        return ['classes'=>$classes,'grades'=>$grades];
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
          'formName' => 'required',
          'grade_id' => 'required',
      ]);

      $grade_id = request('grade_id');
      $account_id = DB::table('grades')->where('id',$grade_id)->value('account_id');
      $class = new Form;

      $class -> formName = request('formName');
      $class -> grade_id = request('grade_id');
      $class -> account_id = $account_id;

      $class ->save();

      return $this -> index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this -> validate(request(),[
          'formName' => 'required',
          'grade_id' => 'required'
      ]);

      $grade_id = request('grade_id');
      $account_id = DB::table('grades')->where('id',$grade_id)->value('account_id');

      $class = Form::find($id);

      $class -> formName = request('formName');
      $class -> grade_id = request('grade_id');
      $class -> account_id = $account_id;
      $class -> save();

      return $this -> index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $class = Form::find($id);
      $class -> delete();

      return $this -> index();
    }
}
