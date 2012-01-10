<?php 
require_once('../../login/config.php');
if(isset($_POST['kod_latihan']))
{
	$kod 		= $_POST['kod_latihan'];

	$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Unable to connect to Database Server.");
	mysql_select_db (DB_DATABASE, $db) or die ("Could not select database.");

	$sql_check = mysql_query("SELECT ts_latihan_id, ts_latihan_kod, ts_latihan_nama FROM ts_latihan WHERE ts_latihan_kod='".$kod."' OR ts_latihan_nama LIKE '%".$kod."%' LIMIT 5") or die(mysql_error());

	if(mysql_num_rows($sql_check))
	{
		$row = mysql_fetch_row($sql_check);
		echo "<p class='msg info'><a href='list-peserta-latihan.php?ts_latihan_id=$row[0]'>$row[1]&nbsp;|&nbsp;$row[2]</a></p>";
	}
	else
	{
		echo 'OK';
	}
mysql_close($db);
}
?>
