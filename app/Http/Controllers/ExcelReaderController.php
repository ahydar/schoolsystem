<?php

namespace App\Http\Controllers;

use App\ExcelReader\PhpExcelReader;
use Illuminate\Http\Request;

class ExcelReaderController extends Controller
{
    //
    public function read(Request $request)
    {
        $filename = $request->file('marksheet')->getRealPath();
        $request->file('marksheet')->store('marksheets');
        $excel = new PhpExcelReader;

        $excel->read($filename);
        
        $sheet = $excel->sheets[8];

        $marks = [];

        $startRow = 14;
        for($i=0;$i<$sheet['numRows']-$startRow;$i++){
            if(isset($sheet['cells'][$startRow+$i][6])){
                $data = [
                    'Name' => $sheet['cells'][$startRow+$i][6],
                    'mark1' => $sheet['cells'][$startRow+$i][7],
                    'mark2' => $sheet['cells'][$startRow+$i][8],
                    'mark3' => $sheet['cells'][$startRow+$i][9],
                    'mark4' => $sheet['cells'][$startRow+$i][10],
                    //'final' => $sheet['cells'][$startRow+$i][38],
                ];
            }
            
            $marks[] = $data;
        }
        
        return $marks;
    }
}
