<?php
//Connect to database from here
$link = mysql_connect('202.190.32.26', 'root', 'xs2mysql'); 
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//select the database | Change the name of database from here
mysql_select_db('mardilms'); 

if(!isset($_GET['ts_session'])){
echo "<center><font face='Verdana' size='2' color=red>
Maaf, skrip gagal </font></center>";
exit;
}

	$todo=$_POST['todo'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	
	if(isset($todo) and $todo=="change-password"){
	$password=mysql_real_escape_string($password);
	}
	$status = "OK";
	$msg="";
	
	if ( strlen($password) < 3 or strlen($password) > 8 ){
	$msg=$msg."Password must be more than 3 char legth and maximum 8 char lenght<BR>";
	$status= "NOTOK";}
	
	if ( $password <> $password2 ){
	$msg=$msg."Both passwords are not matching<BR>";
	$status= "NOTOK";}
	
	if($status<>"OK"){ 
	echo "<font face='Verdana' size='2' color=red>$msg</font><br><center><input type='button' value='Retry' onClick='history.go(-1)'></center>";
	}else{ // if all validations are passed.
	if(mysql_query("UPDATE ts_admin SET ts_admin_password='md5($password)' WHERE ts_admin_password='$todo'")){
	echo "<font face='Verdana' size='2' ><center>Thanks <br> Your password changed successfully. Please keep changing your password for better security</font></center>";
	}
	}
?>