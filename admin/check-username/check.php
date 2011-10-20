<?php 
// Database initialization
include('../../login/config.php');

	$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Unable to connect to Database Server.");
	mysql_select_db (DB_DATABASE, $db) or die ("Could not select database.");
	
// Check IC if exist	
if(isset($_POST['ic_no']))
{
	$username = $_POST['ic_no'];

	$sql_check = mysql_query("SELECT ts_peserta_ic FROM ts_peserta WHERE ts_peserta_ic='".$username."'") or die(mysql_error());

	if(mysql_num_rows($sql_check))
	{
		echo '<font color="red">Rekod <STRONG>'.$username.'</STRONG> telah ada dalam database.</font>';
		echo '<p><div class="buttons"><a href="#"><img src="img/icons/group_add.png" alt=""/>Tambah Peserta</a></div></p>';
	}
	else
	{
		echo 'OK';
	}
}
// Check if email exist
else if(isset($_POST['email']))
{
	$email = $_POST['email'];

	$sql_check = mysql_query("SELECT ts_peserta_email FROM ts_peserta WHERE ts_peserta_email='".$email."'") or die(mysql_error());

	if(mysql_num_rows($sql_check))
	{
		echo '<font color="red"><STRONG>'.$email.'</STRONG> telah ada dalam database.</font>';
	}
	else
	{
		echo 'OK';
	}
}

// Check if Kursus exit
else if(isset($_POST['kursus_id'])){
	
	$id = $_POST['kursus_id'];
	
	$sql_check = mysql_query("SELECT ts_kursus_kod FROM ts_kursus WHERE ts_kursus_kod='".$username."'") or die(mysql_error());
	if(mysql_num_rows($sql_check))
	{
		echo '<p>Rekod <strong>'.$id .'</strong> telah ada dalam database.</p>';
	}
	else
	{
	echo 'OK';
	}

}
?>