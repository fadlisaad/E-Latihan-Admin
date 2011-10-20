<?php require_once('Connections/ts.php');

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO ts_peserta (ts_peserta_nama, ts_peserta_ic, ts_peserta_handfone, ts_peserta_homeline, ts_peserta_alamat, ts_peserta_email, ts_peserta_umur, ts_peserta_jantina, ts_peserta_perkahwinan, ts_peserta_pendidikan, ts_peserta_pekerjaan, ts_peserta_perusahaan, ts_majikan_nama, ts_majikan_alamat, ts_majikan_telefon, ts_peserta_register_date, ts_peserta_password, ts_peserta_status, ts_peserta_year, active) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['ic_no'], "text"),
                       GetSQLValueString($_POST['handphone'], "text"),
					   GetSQLValueString($_POST['home'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['umur'], "int"),
					   GetSQLValueString($_POST['jantina'], "text"),
					   GetSQLValueString($_POST['perkahwinan'], "text"),
					   GetSQLValueString($_POST['pendidikan'], "text"),
					   GetSQLValueString($_POST['pekerjaan'], "text"),
					   GetSQLValueString($_POST['perusahaan'], "text"),
					   GetSQLValueString($_POST['nama_majikan'], "text"),
					   GetSQLValueString($_POST['alamat_majikan'], "text"),
					   GetSQLValueString($_POST['telefon_majikan'], "int"),
                       GetSQLValueString($_POST['register'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
					   GetSQLValueString($_POST['id'], "int"),
					   GetSQLValueString($_POST['year'], "int"),
                       GetSQLValueString($_POST['status'], "int"));

  mysql_select_db($database_ts, $ts);
  $Result1 = mysql_query($insertSQL, $ts) or die(mysql_error());

  $insertGoTo = "index.php?option=com_jumi&fileid=23&ts_kursus_id=".$_POST['ts_kursus_id']."";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>