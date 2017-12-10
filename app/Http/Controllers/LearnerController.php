<?php

namespace App\Http\Controllers;

use App\Learner;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Repositories\Learners;

class LearnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Learners $learners)
    {
        //
        return $learners -> all();
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
          'yearsInPhase' => 'required',
          'learnerNumber' => 'required',
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
        $user -> usertype_id = 2;
        $user -> account_id = $account_id;
        $user -> password = bcrypt('password');

        $user -> save();


        $learner = new Learner;

        $learner ->  yearsInPhase = request('yearsInPhase');
        $learner -> learnerNumber = request('learnerNumber');
        $learner -> form_id = request('form_id');
        $learner -> account_id = $account_id;


        $user -> learner() -> save($learner);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function show(Learner $learner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function edit(Learner $learner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this -> validate(request(),[
          'id' => 'required',
          'firstName' => 'required',
          'lastName' => 'required',
          'email' => 'required|email',
          'yearsInPhase' => 'required',
          'learnerNumber' => 'required',
          'form_id' => 'required',
          'gender' => 'required'
        ]);

        $user = User::find($id);

        if(count($user) < 0){
            return ["exists" => "User does not exists"];
        }
        $user -> firstName = request('firstName');
        $user -> lastName = request('lastName');
        $user -> userName = request('email');
        $user -> email = request('email');
        $user -> gender = request('gender');
        $user -> save();


        $learner = $user -> learner;

        $learner ->  yearsInPhase = request('yearsInPhase');
        $learner -> learnerNumber = request('learnerNumber');
        $learner -> form_id = request('form_id');

        $learner -> save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Learner  $learner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Learners $learners)
    {
        //
        $user = User::find($id);

        $learner = $user -> learner;

        if($learner != null){
          $learner -> delete();
        }

        $user -> delete();

        return $learners -> all();
    }
}
