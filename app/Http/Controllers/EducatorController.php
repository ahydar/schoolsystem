<?php

namespace App\Http\Controllers;

use App\Educator;
use App\User;
use Illuminate\Http\Request;
use Auth;

class EducatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        'title' => 'required'
      ]);

      $account_id = Auth::user() -> account_id;

      $user_exist = User::where('email','3140171@myuwc.ac.za')->get();

      if(count($user_exist) > 0){
          return ["exists" => "User with the provided email exist already"];
      }
      $user = new User;
      $user -> firstName = request('firstName');
      $user -> lastName = request('lastName');
      $user -> userName = request('email');
      $user -> email = request('email');
      $user -> usertype_id = 1;
      $user -> account_id = $account_id;
      $user -> password = bcrypt('password');

      $user -> save();


      $educator = new Educator;

      $educator ->  title = request('title');
      $educator -> initial = request('initial');
      $educator -> account_id = $account_id;

      $user -> educator() -> save($educator);

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
