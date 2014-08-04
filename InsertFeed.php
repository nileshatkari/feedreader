<?php

   $feedUrlLocation= $_POST['val'];
   $host="mysql9.000webhost.com";
   $user="a9362808_root";
   $pass="root123";
   $db="a9362808_student";
   $con=mysqli_connect($host,$user, $pass,$db);
   // Check connection
   if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }

     mysqli_query($con,"INSERT INTO feedurl (feed)
     VALUES ('$feedUrlLocation')");

     mysqli_close($con);
?> 