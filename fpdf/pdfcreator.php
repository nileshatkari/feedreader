<?php
require('WriteHTML.php');
$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');

$url=$_POST['val'];

$pdf->WriteHTML($url);
$pdf->Output('Mypdf.pdf','F'); 
//$pdf->Output();

?>