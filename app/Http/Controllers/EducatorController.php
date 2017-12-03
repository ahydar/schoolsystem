<?php

namespace App\Http\Controllers;

use App\Educatorform;
use App\Educator;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;

class EducatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $account_id  = Auth::user() -> account_id;
      $classes = DB::table('users')
                    ->leftJoin('educators','users.id','=','educators.user_id')
                    ->leftJoin('educatorforms','educators.id','=','educatorforms.educator_id')
                    ->leftJoin('forms','forms.id','=','educatorforms.form_id')
                    ->select('users.*','title','initial','formName')
                    ->where('users.account_id','=',$account_id)
                    ->get();
      return ['educators'=>$classes];
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
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required|email',
        'initial' => 'required',
        'title' => 'required',
        'form_id' => 'required',
        'gender' => 'required'
      ]);

      $account_id = Auth::user() -> account_id;

      $user_exist = User::where('email','=',request('email'))->get();

      if(count($user_exist) > 0){
          return ["exists" => "User with the provided email exist already"];
      }
      $user = new User;
      $user -> firstName = request('firstName');
      $user -> lastName = request('lastName');
      $user -> userName = request('email');
      $user -> email = request('email');
      $user -> gender = request('gender');
      $user -> usertype_id = 1;
      $user -> account_id = $account_id;
      $user -> password = bcrypt('password');

      $user -> save();


      $educator = new Educator;

      $educator ->  title = request('title');
      $educator -> initial = request('initial');
      $educator -> account_id = $account_id;


      $user -> educator() -> save($educator);

      if(request('form_id') != 0){
        $educatorform = new EducatorForm;

        $educatorform -> form_id = request('form_id');
        $educatorform -> account_id = $account_id;

        $educator -> educatorforms() -> save($educatorform);
      }

      return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function show(Educator $educator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function edit(Educator $educator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Educator $educator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educator $educator)
    {
        //
    }
}
