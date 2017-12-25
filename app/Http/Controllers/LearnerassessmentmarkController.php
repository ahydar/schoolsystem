<?php

namespace App\Http\Controllers;

use App\Learnerassessmentmark;
use Illuminate\Http\Request;
use Auth;

class LearnerassessmentmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $l = Learnerassessmentmark::get();

        return $l;
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Learnerassessmentmark  $learnerassessmentmark
     * @return \Illuminate\Http\Response
     */
    public function show(Learnerassessmentmark $learnerassessmentmark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Learnerassessmentmark  $learnerassessmentmark
     * @return \Illuminate\Http\Response
     */
    public function edit(Learnerassessmentmark $learnerassessmentmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Learnerassessmentmark  $learnerassessmentmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Learnerassessmentmark $learnerassessmentmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Learnerassessmentmark  $learnerassessmentmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Learnerassessmentmark $learnerassessmentmark)
    {
        //
    }
}
