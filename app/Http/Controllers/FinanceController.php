<?php

namespace App\Http\Controllers;

use App\Finance;
use Illuminate\Http\Request;
use Auth;
use App\User;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $account_id = Auth::user()->account_id;
        
        $learners = User::with('finance')
                        ->where([
                            ['usertype_id','=',2],['users.account_id','=',$account_id]
                            ])
                        ->join('learners','users.id','=','learners.user_id')
                        ->select('users.id','firstName','lastName','learnerNumber')
                        ->get();

         $maxPayments = $learners -> max('finance') -> count();

        return ['learners' => $learners,'maxPayments' => $maxPayments];
    }

    public function setup($finance)
    {
        $account_id = Auth::user()->account_id;

        $this -> validate(request(),[
            'amount' => 'required|numeric',
            'description' => 'required',
            'receiptNumber' => 'required',
            'paymentDate' => 'required',
            'user_id' => 'required'
        ]);

        $finance -> amount = request('amount');
        $finance -> description = request('description');
        $finance -> receiptNumber = request('receiptNumber');
        $finance -> paymentDate = request('paymentDate');
        $finance -> user_id = request('user_id');
        $finance -> account_id = $account_id;

        $finance -> save();
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
        
        $finance = new Finance;

        $this -> setup($finance);
        
        return $finance;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $finance = Finance::find($id);
        $this -> setup($finance);
        return $finance;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {
        //
    }
}
