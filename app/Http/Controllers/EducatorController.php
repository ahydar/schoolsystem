<?php

namespace App\Http\Controllers;

use App\Educatorform;
use App\Educator;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;


use App\Repositories\Educators;

class EducatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Educators $educators)
    {
      return $educators -> all();
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

        $educator -> educatorform() -> save($educatorform);
      }

      return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Educator  $educator
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
          'initial' => 'required',
          'title' => 'required',
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


        $educator = $user -> educator;

        $educator ->  title = request('title');
        $educator -> initial = request('initial');

        $educator -> save();

        if(request('form_id') != 0){
            $educatorform = $educator -> educatorform;

            //checking if and educator exists
            if($educatorform != null){
                $educatorform -> form_id = request('form_id');
                $educatorform -> save();
            }else{
                $educatorform = new Educatorform;
                $educatorform -> form_id = request('form_id');
                $educatorform -> account_id = $educator -> account_id;

                $educator -> educatorform() -> save($educatorform);
            }
        }else{
            $educatorform = $educator -> educatorform;
            if($educatorform != null){
                $educatorform -> delete();
            }
        }

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Educator  $educator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);

      $educator = $user -> educator;

      $educatorform = $educator -> educatorform;

      if($educatorform != null){
        $educatorform -> delete();
      }

      $educator -> delete();

      $user -> delete();

      return "Deleted";
    }
}
