<?php
require('fpdf.php');

$pdfContent=$_POST['val'];

$str1=explode("<t>", $pdfContent);
$len=sizeOf($str1);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$title="";
$desc="";
for($i=0;$i<($len-1);$i++)
{
  $str2=explode("<p>",$str1[$i]);
  $title=$str2[0]."\n";//DESCRIPTION :".$str2[1]."\n";
  
  $ee=$str2[0]."\n\n";
  $pdf->SetFont('Arial','B',16);
  $pdf->Write(5,$title,$str2[1]);
  $pdf->SetFont('Arial','',12);
  $desc=$str2[2]."\n\n\n\n";
  $pdf->Write(5,$desc);
}
 
$pdf->Output('Mypdf.pdf','F');

echo $pdfContent;
?>
