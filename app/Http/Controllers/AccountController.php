<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $accounts = Account::all();
      return $accounts;
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
          'accountName' => 'required',
          'accountType' => 'required'
      ]);

      $account = new Account;

      $account -> accountName = request('accountName');
      $account -> accountType = request('accountType');

      $account ->save();

      $accounts = Account::all();
      return $accounts;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(Request $request,$id)
    {
          $this -> validate(request(),[
              'accountName' => 'required',
              'accountType' => 'required'
          ]);
          
          $account = Account::find($id);

          $account -> accountName = request('accountName');
          $account -> accountType = request('accountType');
          $account -> save();

          $accounts = Account::all();
          return $accounts;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $account = Account::find($id);
      $account -> delete();

      $accounts = Account::all();
      return $accounts;
    }
}
