<?php 
require_once('../../login/config.php');
if(isset($_POST['kod_kursus']))
{
	$kod 		= $_POST['kod_kursus'];

	$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Unable to connect to Database Server.");
	mysql_select_db (DB_DATABASE, $db) or die ("Could not select database.");

	$sql_check = mysql_query("SELECT ts_kursus_id, ts_kursus_kod, ts_kursus_nama FROM ts_kursus WHERE ts_kursus_kod='".$kod."' OR ts_kursus_nama LIKE '%".$kod."%' LIMIT 5") or die(mysql_error());

	if(mysql_num_rows($sql_check))
	{
		$row = mysql_fetch_row($sql_check);
		echo "<p class='msg info'><a href='list-peserta-kursus.php?ts_kursus_id=$row[0]'>$row[1]&nbsp;|&nbsp;$row[2]</a></p>";
	}
	else
	{
		echo 'OK';
	}
mysql_close($db);
}
?>
