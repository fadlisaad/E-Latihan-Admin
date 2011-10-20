<?php require_once('../Connections/ts_kursus.php'); ?>
<?php require_once('auth.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_user_login = "-1";
if (isset($_SESSION['SESS_USERNAME'])) {
  $colname_user_login = $_SESSION['SESS_USERNAME'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_user_login = sprintf("SELECT * FROM ts_peserta WHERE ts_peserta_ic = %s", GetSQLValueString($colname_user_login, "text"));
$user_login = mysql_query($query_user_login, $ts_kursus) or die(mysql_error());
$row_user_login = mysql_fetch_assoc($user_login);
$totalRows_user_login = mysql_num_rows($user_login);

$colname_user_daftar = "-1";
if (isset($_GET['ts_peserta_ic'])) {
  $colname_user_daftar = $_GET['ts_peserta_ic'];
}
$colname2_user_daftar = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname2_user_daftar = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_user_daftar = sprintf("SELECT ts_kursus.*, ts_peserta.ts_peserta_ic, ts_peserta.ts_peserta_ID, ts_invoice.invoices FROM ts_peserta, ts_kursus, ts_invoice WHERE ts_peserta.ts_peserta_ic = %s AND ts_kursus.ts_kursus_id = %s AND ts_invoice.peserta_id=ts_peserta.ts_peserta_ID AND ts_invoice.kursus_id=%s", GetSQLValueString($colname_user_daftar, "text"),GetSQLValueString($colname2_user_daftar, "int"),GetSQLValueString($colname2_user_daftar, "int"));
$user_daftar = mysql_query($query_user_daftar, $ts_kursus) or die(mysql_error());
$row_user_daftar = mysql_fetch_assoc($user_daftar);
$totalRows_user_daftar = mysql_num_rows($user_daftar);
?>
<?php
	$to = $row_user_login['ts_peserta_email'];
	$subject = "Pengesahan Pendaftaran untuk kursus ". $row_user_daftar['ts_kursus_nama']."";

	$message = "
	<html><body>
	<p>Assalamualaikum dan salam sejahtera ". $row_user_login['ts_peserta_nama']."</p>

	<p>Berikut adalah keterangan pendaftaran Tuan/Puan untuk kursus ".$row_user_daftar['ts_kursus_nama']."</p>
	<p>Tarikh Pendaftaran: ".date('d-m-Y')."<br>
	Kod: ".$row_user_daftar['ts_kursus_kod']."<br>
	Kategori: ".$row_user_daftar['ts_kursus_kategori']."<br>
	Sinopsis: ".strip_tags($row_user_daftar['ts_kursus_keterangan'])."<br><br>

	Lokasi: ".$row_user_daftar['ts_kursus_lokasi']."<br>
	Tarikh Mula: ".$row_user_daftar['ts_kursus_tarikh_mula']."<br>
	Tarikh Tamat: ".$row_user_daftar['ts_kursus_tarikh_tamat']."<br>
	Yuran: RM ".$row_user_daftar['ts_kursus_harga']."<br>
	Invois: ".$row_user_daftar['invoices']."<br><br>
	Nama: ".$row_user_login['ts_peserta_nama']."<br>
	Alamat: ".strip_tags($row_user_login['ts_peserta_alamat'])."<br>
	E-mail: ".$row_user_login['ts_peserta_email']."<br>
	Telefon: ".$row_user_login['ts_peserta_handfone']."<br>
	No Kad Pengenalan/Passport: ".$row_user_login['ts_peserta_ic']."<br><br>

	Untuk keterangan lanjut sila hubungi urusetia kursus di talian 03-89437238 (Program Kursus dan Latihan Teknikal).<br>
	Sekian.<br><br>
	b/p Timbalan Pengarah, Program Kursus dan Latihan Teknikal<br>
	Pusat Perkhidmatan Teknikal<br>
	Ibu Pejabat MARDI<br>
	Peti Surat 12301<br>
	50774 KUALA LUMPUR<br>
	Hakcipta terpelihara Program Kursus dan Latihan Teknikal untuk E-Latihan. Dijana oleh komputer. Tandatangan tidak diperlukan</p></body></html>";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'Cc: elatihan@mardi.my' . "\r\n";
	$headers .= 'Cc: najwa@mardi.my' . "\r\n";
	mail ($to,$subject,$message,$headers);
	header("location:user.php?ts_peserta_ic=".$_SESSION['SESS_USERNAME']."");
	exit();
	

mysql_free_result($user_daftar);
?>