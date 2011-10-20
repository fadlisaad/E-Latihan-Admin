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

$colname_email = "-1";
if (isset($_GET['ts_admin_ID'])) {
  $colname_email = $_GET['ts_admin_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_email = sprintf("SELECT * FROM ts_admin WHERE ts_admin_ID = %s", GetSQLValueString($colname_email, "int"));
$email = mysql_query($query_email, $ts_kursus) or die(mysql_error());
$row_email = mysql_fetch_assoc($email);
$totalRows_email = mysql_num_rows($email);

// switch the value of $email to the
// persons email address you are sending
// this to.

$email = ;
$subject = "Pendaftaran Kursus". $row_e_mail['ts_kursus_nama'] ."di MARDILMS bertarikh ". $row_e_mail['ts_peserta_register_date'];

$body = "Assalamualaikum dan salam sejahtera ". $row_e_mail['ts_peserta_nama'].".\n";

$body .= "Berikut adalah keterangan pendaftaran Tuan/Puan untuk kursus ". $row_e_mail['ts_kursus_nama']."\n\n";
$body .= "Kod: ".$row_e_mail['ts_kursus_kod']."\n";
$body .= "Kategori: ".$row_e_mail['ts_kursus_kategori']."\n";
$body .= "Keterangan: ".htmlentities $row_e_mail['ts_kursus_keterangan']."\n";
$body .= "Lokasi:".$row_e_mail['ts_kursus_lokasi']."\n";
$body .= "Tarikh: ".$row_e_mail['ts_kursus_tarikh_mula']." hingga". $row_e_mail['ts_kursus_tarikh_tamat']."\n";
$body .= "Yuran:RM ".$row_e_mail['ts_kursus_harga']."\n\n";
$body .= "Nama:".$row_e_mail['ts_peserta_nama']."\n";
$body .= "Telefon:".$row_e_mail['ts_peserta_handfone']."\n";
$body .= "No Kad Pengenalan/Passport:".$row_e_mail['ts_peserta_ic']."\n\n";

$body .= "Pendaftaran Tuan/Puan masih tidak aktif. Sila klik pada link dibawah untuk mengaktifkan pendaftaran Tuan/Puan.\n\n";
$body .= "http://elearn.mardi.gov.my/ts/activate.php?ts_peserta_ID=".$row_e_mail['ts_peserta_ID']."\n\n";
$body .= "Sekian.\n\n";
$body .= "Pengurusan Kursus Teknikal, TS, MARDI Serdang\n";

$headers = "From: norlida@mardi.gov.my\n";
$headers .= "Reply-to: noreply@mardi.gov.my\n";
$headers .= "Content-Type: text/plain; charset=iso-8859-1\n";

mail ($email, $subject, $body, $headers);

echo "Pendaftaran aktif";

header("Location: http://localhost/mardilms/ts/user/user-page.php?ts_peserta_ID=".$row_e_mail['ts_peserta_ID']);

mysql_free_result($email);
?>