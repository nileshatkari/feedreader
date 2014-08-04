 <?php
$dbHost = "mysql9.000webhost.com";
$dbUsername ="a9362808_root";
$dbPassword ="root123";
$dbDatabase ="a9362808_student";
$db = mysql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database Server.");
mysql_select_db ($dbDatabase, $db) or die ("Could not select database.");



    $sql_in= mysql_query("SELECT feed,recent FROM feedurl order by recent desc");
     while($r=mysql_fetch_array($sql_in))
      {
          echo $r['feed']." ";
      }

     $result=mysql_query("SELECT MAX(recent) AS max_recent FROM feedurl");
     $row = mysql_fetch_array($result);
     echo $row["max_recent"];



?>

