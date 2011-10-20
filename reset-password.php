<?php
 error_reporting(0);
 ini_set("display_errors", 0);
 session_start();

if( isset($_POST['submit'])) {
//Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
//This script is complete
//Connect to database from here
$link = mysql_connect('202.190.32.26', 'root', 'xs2mysql'); 
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//select the database | Change the name of database from here
mysql_select_db('mardilms'); 

//get e-mail address from reset.php
$email=$_POST['e-mail'];
$email=mysql_real_escape_string($email);
$status = "OK";
$msg="";
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
// You can supress the error message by un commenting the above line
if (!stristr($email,"@") OR !stristr($email,".")) {
$msg="Either your email address is not correct or you had entered wrong e-mail address. <BR>Please check again.<BR>";
$status= "NOTOK";}


echo "<br><br>";
if($status=="OK"){ // validation passed now we will check the tables
$query="SELECT ts_admin_ID, ts_admin_username, ts_admin_password, ts_admin_email FROM ts_admin WHERE ts_admin_email = '$email'";
$st=mysql_query($query);
$recs=mysql_num_rows($st);
$row=mysql_fetch_object($st);
$em=$row->ts_admin_email;// email is stored to a variable
if ($recs == 0) { // No records returned, so no email address in our table
// let us show the error message
echo "<center><font face='Verdana' size='2' color=red><b>Tiada rekod</b><br> Maaf, alamat e-mail anda tiada dalam rekod kami.</center>";
echo "<center><a href='reset.php'>Klik disini</a> untuk mencuba semula atau pergi ke halaman <a href='login/login.php'>Login</a></center>";
exit;}

// formating the mail posting
// headers here
$from ="elatihan@mardi.gov.my"; // Change this address within quotes to your address
$headers ="Reply-to: $headers4\n";
$headers = "From: $headers4\n";
$headers = "Errors-to: $from\n";
$headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;
// for html mail un-comment the above line

// mail function will return true if it is successful
if(mail("$em","Tukar kata laluan untuk laman e-Latihan","<p>E-mail ini telah dihantar ke alamat e-mail anda kerana anda telah meminta untuk menukar/reset kata laluan anda. Berikut adalah keterangan login dan e-mail anda.</p><p>Login ID: $row->ts_admin_username</p><p> E-mail: $row->ts_admin_email</p><p>Sila klik pada pautan dibawah ini untuk menukar kata laluan anda.</p><p><a href='http://elearn.mardi.gov.my/ts/change-password.php?ts_session=".$row->ts_admin_password."&ts_id=".$row->ts_admin_ID."'>Ubah kata laluan</a></p><p>Masukkan kod ini (cut and paste) ke URL browser anda jika pautan diatas tidak berfungsi: http://elearn.mardi.gov.my/ts/change-password.php?ts_session=".$row->ts_admin_password."&ts_id=".$row->ts_admin_ID." </p><p>Sekian, terima kasih.</p><p> Administrator, e-Latihan MARDI</p>","$headers")){echo "<center><font face='Verdana' size='2' ><b>TERIMA KASIH.</b> <br>Satu e-mail dengan keterangan untuk menukar/reset kata laluan telah dihantar ke alamat e-mail anda [$row->ts_admin_email]. <br>Sila semak e-mail anda.<br><a href='login/login.php'>Klik disini untuk ke halaman Login</a> | <a href='../index.php'>Kembali ke halaman utama</a></center>";}

else{// there is a system problem in sending mail
echo " <center><font face='Verdana' size='2' color=red >Maaf. Terdapat masalah dengan server e-mail kami dalam memproses e-mail anda. Sila maklumkan kepada pentadbir laman ini untuk tindakan lanjut. <br>e-latihan@mardi.gov.my</font> <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center>";}

}
else {// Validation failed so show the error message
echo "<center><font face='Verdana' size='2' color=red >$msg <br><br><input class='butt' type='button' value='Cuba semula' onClick='history.go(-1)'></center></font>";}
		// echo 'Thank you. Your message said "'.$_POST['message'].'"';
		//unset($_SESSION['security_code']);

} else {

}
?>
