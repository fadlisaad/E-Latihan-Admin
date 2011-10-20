<?php 
require_once('../../login/config.php');

if(isset($_POST['kursus_kod']))
{
	$username = $_POST['kursus_kod'];

	$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Unable to connect to Database Server.");
	mysql_select_db (DB_DATABASE, $db) or die ("Could not select database.");

	$sql_check = mysql_query("SELECT ts_kursus_kod FROM ts_kursus WHERE ts_kursus_kod='".$username."'") or die(mysql_error());

	if(mysql_num_rows($sql_check))
	{
		echo '<font color="red">Kod kursus <STRONG>'.$username.'</STRONG> telah ada dalam database.</font>';
	}
	else
	{
		echo 'OK';
	}
}
?>