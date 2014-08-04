<?php
 
class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }

   function resizeTransparentImage($width,$height) {
    $new_image = imagecreatetruecolor($width, $height);
    if( $this->image_type == IMAGETYPE_GIF || $this->image_type == IMAGETYPE_PNG ) {
        $current_transparent = imagecolortransparent($this->image);
        if($current_transparent != -1) {
            $transparent_color = imagecolorsforindex($this->image, $current_transparent);
            $current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
            imagefill($new_image, 0, 0, $current_transparent);
            imagecolortransparent($new_image, $current_transparent);
        } elseif( $this->image_type == IMAGETYPE_PNG) {
            imagealphablending($new_image, false);
            $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagefill($new_image, 0, 0, $color);
            imagesavealpha($new_image, true);
        }
    }
    imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
    $this->image = $new_image; 
  }
 
}


//$file_location = 'C:\\xampp\\htdocs\\stat\\'; # Image folder Path
   $image = new SimpleImage();
   $target=""; 
   $fullString=$_POST['val']; 
   $urlArray=explode("*",$fullString);
   $len=sizeof($urlArray)-1;
   for($i=0;$i<$len;$i++){
	      $urlLocation=$urlArray[$i];
		  if($urlLocation!=" ")
		  {
		     $filename=explode("/", $urlLocation); 
                     $image->load($urlLocation);	
                     $image->resize(180,180);	
                     $image->save('resizedimages/'.end($filename));
                     $target=$target.'resizedimages/'.end($filename).'*'; 			
		  }
		  else{
		        $target=$target.$urlLocation.'*';
		      }
		  
     }
    echo $target;



  
 
?>