<?php require_once('Connections/ts.php'); 
	//Error state
	error_reporting(0);					//currently set to 0 (for production), E_ALL (for development)

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

$colname_daftar = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_daftar = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts, $ts);
$query_daftar = sprintf("SELECT * FROM ts_peserta,ts_kursus WHERE ts_kursus.ts_kursus_id=%s AND ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status", GetSQLValueString($colname_daftar, "int"));
$daftar = mysql_query($query_daftar, $ts) or die(mysql_error());
$row_daftar = mysql_fetch_assoc($daftar);
$totalRows_daftar = mysql_num_rows($daftar);

	$to = $row_daftar['ts_peserta_email'];
	$subject = "Pendaftaran untuk kursus ". $row_daftar['ts_kursus_nama']."";

	$message = "Assalamualaikum dan salam sejahtera ". $row_daftar['ts_peserta_nama'].".\n";

	$message .= "Berikut adalah keterangan pendaftaran Tuan/Puan untuk kursus ". $row_daftar['ts_kursus_nama']."Sesi ". $row_daftar['ts_kursus_year']."\n\n";
	$message .= "Tarikh Pendaftaran: ".$row_daftar['ts_peserta_register_date']."\n";
	$message .= "Kod: ".$row_daftar['ts_kursus_kod']."\n";
	$message .= "Kluster: ".$row_daftar['ts_kursus_kategori']."\n";
	$message .= "Sinopsis: ".strip_tags($row_daftar['ts_kursus_keterangan'])."";
	$message .= "\n";
	$message .= "Lokasi: ".$row_daftar['ts_kursus_lokasi']."\n";
	$message .= "Tarikh Mula: ".$row_daftar['ts_kursus_tarikh_mula']."\n";
	$message .= "Tarikh Tamat: ".$row_daftar['ts_kursus_tarikh_tamat']."\n";
	$message .= "Yuran: RM ".$row_daftar['ts_kursus_harga']."\n\n";
	$message .= "Nama: ".$row_daftar['ts_peserta_nama']."\n";
	$message .= "Alamat: ".strip_tags($row_daftar['ts_peserta_alamat'])."\n";
	$message .= "E-mail: ".$row_daftar['ts_peserta_email']."\n";
	$message .= "Telefon: ".$row_daftar['ts_peserta_handfone']."\n";
	$message .= "No Kad Pengenalan/Passport: ".$row_daftar['ts_peserta_ic']."\n\n";
	$message .= "Tuan/Puan boleh menyemak status permohonan ini dengan menggunakan No kad pengenalan Tuan/Puan sebagai ID pengguna dan gunakan kata laluan yang telah didaftarkan tadi.\n\n";	
	$message .= "Pendaftaran Tuan/Puan telah diterima dan akan diproses oleh urusetia program. Sebarang perubahan terhadap masa, tempat, tarikh dan kandungan kursus akan diberitahu kelak melalui e-mail, telefon ataupun surat.\n\n";
	$message .= "Untuk keterangan lanjut sila hubungi urusetia kursus di talian 03-89437238 (TS01).\n\n";
	$message .= "Sekian.\n\n";
	$message .= "b/p Timbalan Pengarah\n\n";
	$message .= "Program Kursus dan Latihan Teknikal\n";	
	$message .= "Hakcipta terpelihara TS01 untuk MARDILMS. Dijana oleh komputer. Tandatangan tidak diperlukan.";
	$from = "elatihan@mardi.gov.my";
	$headers = "From: $from";
	mail($to,$subject,$message,$headers);
?>