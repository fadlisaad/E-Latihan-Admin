<?php 
// This is a sample code in case you wish to check the username from a mysql db table

if(isSet($_POST['ic']))
{
$username = $_POST['ic'];

$dbHost = '202.190.32.26'; // usually localhost
$dbUsername = 'root';
$dbPassword = 'xs2mysql';
$dbDatabase = 'mardilms';

$db = mysql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database Server.");
mysql_select_db ($dbDatabase, $db) or die ("Could not select database.");

$sql_check = mysql_query("select ts_peserta_ic from ts_peserta where ts_peserta_ic='".$username."'") or die(mysql_error());

if(mysql_num_rows($sql_check))
{
echo '<font color="red">Rekod <STRONG>'.$username.'</STRONG> telah ada dalam data kami. Sila kembali ke halaman sebelum ini untuk login dan seterusnya mendaftar.</font>';
}
else
{
echo 'OK';
}

}
?>