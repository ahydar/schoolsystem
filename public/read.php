<?php
include "excelreader/excel_reader.php"; //including excel_reader class

// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;

$filename = "Mathematics-11A.xls";
$excel->read($filename);

$sheet = $excel->sheets[0];

//print_r($sheet);
for($i=0;$i<$sheet['numRows']-12;$i++){
    if(isset($sheet['cells'][12+$i][2])){
        echo $sheet['cells'][12+$i][1].": ";
        echo $sheet['cells'][12+$i][2]."<br>";
        echo $sheet['cells'][12+$i][27]."--";
        echo $sheet['cells'][12+$i][28]."--";
        echo $sheet['cells'][12+$i][29]."--";
        echo $sheet['cells'][12+$i][30]."--";
    
        echo $sheet['cells'][12+$i][38]."<br><br>";
    }
   
}
?>