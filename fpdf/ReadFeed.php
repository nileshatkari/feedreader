<?php
require('WriteHTML.php');

try{
$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');


$url=$_POST['val'];//get the feed url
$rss = new DOMDocument();
$rss->load($url);
$feed = array();
foreach ($rss->getElementsByTagName('item') as $node) {
    $item = array ( 
        'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
        'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
        'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
        'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        'content' =>$node->getElementsByTagName('encoded')->item(0)->nodeValue
        
        );
    array_push($feed, $item);
}
$limit = 10;
$pdfTitle="";
$pdfPost="";
$pdfDescription="";
$pdfImg="";
$fullPdf="";
$dd=sizeof($feed);
if (file_exists('Mypdf.pdf')) { unlink ('Mypdf.pdf'); }
//echo 'The Size is :'.$dd;
for($x=0;$x<$dd;$x++) {
    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
    $link = $feed[$x]['link'];
    $description = $feed[$x]['desc'];
    $date = date('l F d, Y', strtotime($feed[$x]['date']));
    $content=$feed[$x]['content'];
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$content, $matches);


    $pdftitle='<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
    $pdfPost='<small><em>Posted on '.$date.'</em></small></p><br/>';
    $pdfDescription='<p>'.$description.'</p><br><br>';


    //echo '<p><strong><a href="'.$link.'"title="'.$title.'">'.$title.'</a></strong><br /></p>';
    echo $link.'</p>';
    echo $title.'</p>';
   // echo '<small><em>Posted on '.$date.'</em></small></p>';
    echo 'Posted on '.$date.'</p>';

    $pdfImg='';

    if(!empty($matches[1][0])){

    $pdfImg='<br><img src="'.$matches[1][0].'" width=180 height=180 alt="noo"></img>';
    echo $matches[1][0].'</p> ';
   }else{
         echo " </p>";
     }  
   echo '<p>'.$description.'</p>';
   echo'<ending>';
   $fullPdf= $pdftitle.$pdfPost.$pdfDescription.$pdfImg;
   $pdf->WriteHTML($fullPdf);
   $pdf->AddPage();

}
 $pdf->Output('Mypdf.pdf','F');


}
catch(Exception $e){
echo 'Message: ' .$e->getMessage();
}
?>