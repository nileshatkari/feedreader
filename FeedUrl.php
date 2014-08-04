<?php
   $urlLocation= $_POST['val'];
   $html = file_get_contents($urlLocation);
   $feedurl=getRSSLocation($html, $urlLocation);
   if (!empty($feedurl))
   {
      echo $feedurl;
   }
   else
   {
       echo 'Not FIND';
   }
function getRSSLocation($html, $urlLocation){
    if(!$html or !$urlLocation){
           return 'No Feed Found';
       }else{
                 
               /*search through the HTML, save all <link> tags
                 and store each link's attributes in an associative array*/
                 preg_match_all('/<link\s+(.*?)\s*\/?>/si', $html, $matches);
                 $links = $matches[1];
                 $final_links = array();
                 $link_count = count($links);
                 for($n=0; $n<$link_count; $n++){
                       $attributes = preg_split('/\s+/s', $links[$n]);
                         foreach($attributes as $attribute){
                             $att = preg_split('/\s*=\s*/s', $attribute, 2);
                               if(isset($att[1])){
                                   $att[1] = preg_replace('/([\'"]?)(.*)\1/', '$2', $att[1]);
                                   $final_link[strtolower($att[0])] = $att[1];
                                 }
            }
             $final_links[$n] = $final_link;
        }
                 #now figure out which one points to the RSS file
                 for($n=0; $n<$link_count; $n++){
                 if(strtolower($final_links[$n]['rel']) == 'alternate'){
                      if(strtolower($final_links[$n]['type']) == 'application/rss+xml'){
                                    $href = $final_links[$n]['href'];
                       }
                     if(!$href and strtolower($final_links[$n]['type']) == 'text/xml'){
                               #kludge to make the first version of this still work
                               $href = $final_links[$n]['href'];
                       }
                     if($href){
                          if(strstr($href, "http://") !== false){ #if it's absolute
                                    $full_url = $href;
                            }else{ 
                                    #otherwise, 'absolutize' it
                                    $url_parts = parse_url($urlLocation);
                                    #only made it work for http:// links. Any problem with this?
                                    $full_url = "http://$url_parts[host]";
                                    if(isset($url_parts['port'])){
                                                 $full_url .= ":$url_parts[port]";
                                      }
                         if($href{0} != '/'){ 
                                  #it's a relative link on the domain
                                  $full_url .= dirname($url_parts['path']);
                                  if(substr($full_url, -1) != '/'){
                                  #if the last character isn't a '/', add it
                                  $full_url .= '/';
                            }
                        }
                        $full_url .= $href;
                    }
                    return $full_url;
                
                }
            }
        }
        
        echo 'No Feed found';
        return null;
    }
}


/*function getFile($urlLocation){
    $ch = curl_init($urlLocation);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}*/

//echo getFile($location);
?>