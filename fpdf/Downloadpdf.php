<?php


//require('fpdf.php');
//$urlLocation='fpdf/Mypdf.pdf';
//$pdf = new FPDF();
//echo $urlLocation; 
//$pdf->Output('http://nileshatkari777.comxa.com/fpdf/Mypdf.pdf','I');

$filename = "fpdf/1234.pdf";
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));
readfile($filename);

?>