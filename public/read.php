<?php
include "excelreader/excel_reader.php"; //including excel_reader class

// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;

$filename = "History.xls";
$excel->read($filename);

$sheet = $excel->sheets[2];

print_r($sheet);
?>