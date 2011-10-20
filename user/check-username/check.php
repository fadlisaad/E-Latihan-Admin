<?php
include("dbConnector.php");
$connector = new DbConnector();

$username = trim(strtolower($_POST['ic']));
$username = mysql_escape_string($username);

$query = "SELECT ts_peserta_ic FROM ts_peserta WHERE ts_peserta_ic = '$username' LIMIT 1";
$result = $connector->query($query);
$num = mysql_num_rows($result);

echo $num;
mysql_close();
?>