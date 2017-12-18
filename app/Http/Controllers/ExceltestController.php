<?php

namespace App\Http\Controllers;
use Excel;
use PDF;

use Illuminate\Http\Request;

class ExceltestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Excel::create('Filename', function($excel) {
            
            $excel->sheet('Sheetname', function($sheet) {
        
                $sheet->fromArray(array(
                    array('data1', 'data2'),
                    array('data3', 'data4')
                ));
        
            });
        
        })->export('xlsx');
        return "Hello there";
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
        $p = $request->file('avatar')->getRealPath();
        /*$data = Excel::load($p,function($render){
                $render->first();
                $render -> skipRows(10)->takeRows(10);
                $render -> takeColumns(5);
        })->all();*/

        $data = Excel::selectSheetsByIndex(0)->load($p,function($render){
            $render->first();
            $render -> skipRows(10)->takeRows(10);
            $render -> takeColumns(5);
    })->all();

        $request->file('avatar')->store('avatars');
        return $data;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdfGenerate()
    {
        $pdf = PDF::loadView('pdffile');
        return $pdf->stream();
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
