<?php

if(isset($_GET['id'])) 
{
$id = $_GET['id'];
$db = mysql_connect("202.190.32.26", "root", "xs2mysql");
mysql_select_db("test", $db) or die(mysql_errno() . ": " . mysql_error() . "<br>");

  $sql = "SELECT * FROM ts_pictures WHERE files_id = $id";
	
  $result = mysql_query($sql, $db);

  $data = mysql_result($result, 0, "content");
  $name = mysql_result($result, 0, "name");
  $size = mysql_result($result, 0, "size");
  $type = mysql_result($result, 0, "type");

  header("Content-type: $type");
  header("Content-length: $size");
  header("Content-Disposition: filename=$name");
  header("Content-Description: PHP Generated Data");
  echo $data;
}
?>