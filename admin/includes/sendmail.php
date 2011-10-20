<?php require_once('../../Connections/ts_kursus.php'); ?>
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
$colname_e_mail = "-1";
if (isset($_GET['ts_peserta_ID'])) {
  $colname_e_mail = $_GET['ts_peserta_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_e_mail = sprintf("SELECT ts_peserta.*, ts_invoice.kursus_id, ts_kursus.* FROM ts_peserta, ts_invoice, ts_kursus WHERE ts_peserta_ID = %s AND ts_peserta.active = 0 AND ts_invoice.peserta_id = ts_peserta.ts_peserta_ID", GetSQLValueString($colname_e_mail, "int"));
$e_mail = mysql_query($query_e_mail, $ts_kursus) or die(mysql_error());
$row_e_mail = mysql_fetch_assoc($e_mail);
$totalRows_e_mail = mysql_num_rows($e_mail);

	// switch the value of $email to the persons email address you are sending this to.
	$email = $row_e_mail['ts_peserta_email'];
	$subject = "Pendaftaran Kursus ". $row_e_mail['ts_kursus_nama'] ."di E-Latihan MARDI bertarikh ". $row_e_mail['ts_peserta_register_date'];

	$body = "Assalamualaikum dan salam sejahtera ". $row_e_mail['ts_peserta_nama'].".\n";

	$body .= "Berikut adalah keterangan pendaftaran Tuan/Puan untuk kursus ". $row_e_mail['ts_kursus_nama']."\n\n";
	$body .= "Kod: ".$row_e_mail['ts_kursus_kod']."\n";
	$body .= "Kategori: ".$row_e_mail['ts_kursus_kategori']."\n";
	$body .= "Lokasi:".$row_e_mail['ts_kursus_lokasi']."\n";
	
if ($row_e_mail['ts_kursus_kategori'] == 'Kursus Berjadual') {
	$body .= "Tarikh: ".$row_e_mail['ts_kursus_tarikh_mula']." hingga". $row_e_mail['ts_kursus_tarikh_tamat']."\n";
}
else {
	$body .= "Tarikh kursus akan ditentukan kelak.\n\n";
}
	$body .= "Yuran:RM ".$row_e_mail['ts_kursus_harga']."\n\n";
	$body .= "Nama:".$row_e_mail['ts_peserta_nama']."\n";
	$body .= "Telefon:".$row_e_mail['ts_peserta_handfone']."\n";
	$body .= "No Kad Pengenalan/Passport:".$row_e_mail['ts_peserta_ic']."\n\n";
	$body .= "Klik disini untuk mengesahkan pendaftaran Tuan/Puan : <a href='http://elearn.mardi.gov.my/pengesahan/".$row_e_mail['activation']."'>http://elearn.mardi.gov.my/pengesahan/".$row_e_mail['activation']."</a><br>";

	$body .= "Untuk keterangan lanjut sila hubungi urusetia kursus di talian 03-89437238 (Program Kursus dan Latihan Teknikal) atau e-mail ke elatihan@mardi.gov.my<br>
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
	$headers .= 'CC: elatihan@mardi.gov.my' . "\r\n";
	mail ($email,$subject,$body,$headers);
	header("Location: ../../user/user-page.php?ts_peserta_ID=".$row_e_mail['ts_peserta_ID']."");
	exit();
?>