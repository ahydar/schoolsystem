<?php

namespace App\Http\Controllers;

use App\Gaurdian;
use App\Repositories\GaurdiansRepository;
use Illuminate\Http\Request;
use App\User;
use App\Userextra;
use Auth;
use DB;


class GaurdianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTemp(GaurdiansRepository $gaurdianRepo,$learner_user_id)
    {
        return $gaurdianRepo -> getOne($learner_user_id);
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
    public function storeTemp(Request $request,$learner_user_id)
    {
        //
        $this -> validate(request(),[
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'relationship' => 'required'
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
          $user -> usertype_id = 3;
          $user -> account_id = $account_id;
          $user -> dob = request('dob');
          $user -> phone = request('phone');
          $user -> password = bcrypt('password');
  
          $user -> save();

          $gaurdian = new Gaurdian;
  
          $gaurdian ->  relationship = request('relationship');
          $gaurdian -> learner_user_id = $learner_user_id;
          $gaurdian -> account_id = $account_id;
  
  
          $user -> gaurdian() -> save($gaurdian);


          $extra = new Userextra;

          $extra -> address = request('address');
          $extra -> postalCode = request('postalCode');
          $extra -> nationality = request('nationality');
          $extra -> maritalStatus = request('maritalStatus');
          $extra -> idNumber = request('idNumber');
          $extra -> totalFees = request('totalFees');
          $extra -> account_id = $account_id;
  
          $user -> userextra() -> save($extra);
          return $user;
    }

    public function updateTemp(Request $request,$user_id)
    {
        //
        $this -> validate(request(),[
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'relationship' => 'required'
          ]);
  
          $account_id = Auth::user() -> account_id;
  
          //$user_exist = User::where('email','=',request('email'))->get();
  
          /*if(count($user_exist) > 0){
              return ["exists" => "User with the provided email exist already"];
          }*/
          $user = User::find($user_id);
          $user -> firstName = request('firstName');
          $user -> lastName = request('lastName');
          $user -> userName = request('email');
          $user -> email = request('email');
          $user -> gender = request('gender');
          $user -> usertype_id = 3;
          $user -> account_id = $account_id;
          $user -> dob = request('dob');
          $user -> phone = request('phone');
  
          $user -> save();

          $gaurdian = $user -> gaurdian;
  
          $gaurdian ->  relationship = request('relationship');
          $gaurdian -> learner_user_id = request('learner_user_id');
          $gaurdian -> account_id = $account_id;
  
  
          $user -> gaurdian() -> save($gaurdian);


          $extra = $user -> userextra;

          $extra -> address = request('address');
          $extra -> postalCode = request('postalCode');
          $extra -> nationality = request('nationality');
          $extra -> maritalStatus = request('maritalStatus');
          $extra -> idNumber = request('idNumber');
          $extra -> totalFees = request('totalFees');
          $extra -> account_id = $account_id;
  
          $user -> userextra() -> save($extra);
          return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gaurdian  $gaurdian
     * @return \Illuminate\Http\Response
     */
    public function show(Gaurdian $gaurdian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gaurdian  $gaurdian
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaurdian $gaurdian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gaurdian  $gaurdian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gaurdian $gaurdian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gaurdian  $gaurdian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gaurdian $gaurdian)
    {
        //
    }
}
