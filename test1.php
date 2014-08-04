<?php
try{
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
$dd=sizeof($feed);
//echo 'The Size is :'.$dd;
for($x=0;$x<$dd;$x++) {
    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
    $link = $feed[$x]['link'];
    $description = $feed[$x]['desc'];
    $date = date('l F d, Y', strtotime($feed[$x]['date']));
    $content=$feed[$x]['content'];
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$content, $matches);

    //echo '<p><strong><a href="'.$link.'"title="'.$title.'">'.$title.'</a></strong><br /></p>';
    echo $link.'</p>';
    echo $title.'</p>';
   // echo '<small><em>Posted on '.$date.'</em></small></p>';
    echo 'Posted on '.$date.'</p>';
    if(!empty($matches[1][0])){
    echo $matches[1][0].'</p> ';
   }else{
         echo " </p>";
     }  
   echo '<p>'.$description.'</p>';
   echo'<ending>';
}
}
catch(Exception $e){
echo 'Message: ' .$e->getMessage();
}
?>