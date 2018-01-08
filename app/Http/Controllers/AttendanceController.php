<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Auth;
use App\User;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$form_id)
    {
        //
        $account_id = Auth::user() -> account_id;
        $week = request('week');
        $user = User::with(['attendance'=>function($query){
                $query->whereIn('date',request('week'));
        }])->join('learners','learners.user_id','=','users.id')->where([
            ['usertype_id','=',2],
            ['form_id','=',$form_id],
            ['users.account_id','=',$account_id]
        ])->select('users.id','firstName','lastName')->get();

        $keyByDate = $user -> map(function($item){
                $item -> daily_attendance = $item -> attendance -> keyBy('date');
                return $item;
        });

        foreach ($keyByDate as $key => $value) {
            foreach ($week as $index => $day) {
                if(!($value -> daily_attendance -> has($day))){
                    $value['daily_attendance'][$day] = [
                        "status" => "Present",
                        "reason" => "",
                        "date" => $day
                    ];
                }
            }
        }
        return $keyByDate;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account_id = Auth::user() -> account_id;
        if(request('id') != null){
            $attendance = Attendance::find(request('id'));
        }else{
            $attendance = new Attendance;
        }

        if(request('status') == "Present" and request('id') != null){
            $attendance -> delete();
        }else if(request('status') != "Present" and request('id') == null){
            $attendance -> status = request('status');
            $attendance -> reason = request('reason');
            $attendance -> account_id = $account_id;
            $attendance -> user_id = request('user_id');
            $attendance -> date = request('date');
            $attendance -> day = substr(request('date'),0,2);
            $attendance -> month = substr(request('date'),3,2);
            $attendance -> year = substr(request('date'),6,4);
            $attendance -> save();
        }
        
        return $attendance;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
