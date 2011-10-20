<?php require_once('Connections/ts_kursus.php'); ?>
<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/ts
 * 
 * Description : script to register user to the system
 */
	error_reporting(0);
	ini_set("display_errors", 0);
?>
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

$colname_daftar = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_daftar = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_daftar = sprintf("SELECT * FROM ts_kursus WHERE ts_kursus.ts_kursus_id=%s", GetSQLValueString($colname_daftar, "int"));
$daftar = mysql_query($query_daftar, $ts_kursus) or die(mysql_error());
$row_daftar = mysql_fetch_assoc($daftar);
$totalRows_daftar = mysql_num_rows($daftar);
?>
<form action="index.php?option=com_jumi&fileid=23&ts_kursus_id=<?php echo $_POST['ts_kursus_id']; ?>" method="POST" name="form">
<input name="e-mail" type="hidden" value="<?php echo $_POST['email']; ?>" />
<input name="nama" type="hidden" value="<?php echo $_POST['name']; ?>" />
<input name="ic" type="hidden" value="<?php echo $_POST['ic']; ?>" />
<input name="handphone" type="hidden" value="<?php echo $_POST['phone']; ?>" />
<input name="homeline" type="hidden" value="<?php echo $_POST['home']; ?>" />
<input name="alamat" type="hidden" value="<?php echo strip_tags($_POST['address']); ?>" />
<input name="umur" type="hidden" value="<?php echo $_POST['umur']; ?>" />
<input name="jantina" type="hidden" value="<?php echo $_POST['jantina']; ?>" />
<input name="perkahwinan" type="hidden" value="<?php echo $_POST['status_perkahwinan']; ?>" />
<input name="pendidikan" type="hidden" value="<?php echo $_POST['pendidikan']; ?>" />
<input name="pekerjaan" type="hidden" value="<?php echo $_POST['pekerjaan']; ?>" />
<input name="perusahaan" type="hidden" value="<?php echo $_POST['perusahaan']; ?>" />
<input name="m_nama" type="hidden" value="<?php echo $_POST['nama_majikan']; ?>" />
<input name="m_alamat" type="hidden" value="<?php echo $_POST['alamat_majikan']; ?>" />
<input name="m_telefon" type="hidden" value="<?php echo $_POST['telefon_majikan']; ?>" />
<input name="register" type="hidden" value="<?php echo $_POST['registerDate']; ?>" />
<input name="password" type="hidden" value="<?php echo $_POST['password']; ?>" />

<input name="id" type="hidden" value="<?php echo $_POST['ts_kursus_id']; ?>" />
<input name="tajuk" type="hidden" value="<?php echo $row_daftar['ts_kursus_nama']; ?>" />
<input name="kod" type="hidden" value="<?php echo $row_daftar['ts_kursus_kod']; ?>" />
<input name="kategori" type="hidden" value="<?php echo $row_daftar['ts_kursus_kategori']; ?>" />
<input name="keterangan" type="hidden" value="<?php echo $row_daftar['ts_kursus_keterangan']; ?>" />
<input name="lokasi" type="hidden" value="<?php echo $row_daftar['ts_kursus_lokasi']; ?>" />
<input name="tarikh_mula" type="hidden" value="<?php echo $row_daftar['ts_kursus_tarikh_mula']; ?>" />
<input name="tarikh_tamat" type="hidden" value="<?php echo $row_daftar['ts_kursus_tarikh_tamat']; ?>" />
<input name="yuran" type="hidden" value="<?php echo $row_daftar['ts_kursus_harga']; ?>" />
<input name="invoice" type="hidden" value="E<?php echo date('ymHms'); ?>" />

<p>Berikut adalah keterangan pendaftaran Tuan/Puan untuk kursus <?php echo $row_daftar['ts_kursus_nama']; ?></p>
<div class="legend"><h3 class="legend-title">Kursus</h3><p>
Tarikh Pendaftaran: <?php echo $_POST['registerDate']; ?><br>
	Kod: <?php echo $row_daftar['ts_kursus_kod']; ?><br>
	Kategori: <?php echo $row_daftar['ts_kursus_kategori']; ?><br>
	Sinopsis: <?php echo $row_daftar['ts_kursus_keterangan']; ?><br>
	<br>

	Lokasi: <?php echo strtoupper($row_daftar['ts_kursus_lokasi']); ?><br>
	Tarikh Mula: <?php echo $row_daftar['ts_kursus_tarikh_mula']; ?><br>
	Tarikh Tamat: <?php echo $row_daftar['ts_kursus_tarikh_tamat']; ?><br>
	Yuran: RM <?php echo $row_daftar['ts_kursus_harga']; ?><br>
	Invois: E<?php echo date('ymHms'); ?>
    </p></div>
	<div class="legend"><h3 class="legend-title">Biodata</h3><p>
	Nama: <?php echo strtoupper($_POST['name']); ?><br>
	Alamat: <?php echo strtoupper($_POST['address']); ?><br>
	E-mail: <?php echo $_POST['email']; ?><br>
	Telefon Bimbit: <?php echo $_POST['phone']; ?><br />
	Telefon Rumah: <?php echo $_POST['home']; ?><br>
    No Kad Pengenalan/Passport: <?php echo $_POST['ic']; ?></p>
  </div>
  <div class="legend"><h3 class="legend-title">Majikan</h3><p>
	  Nama Majikan: <?php echo $_POST['nama_majikan']; ?><br />
	  Alamat Majikan: <?php echo $_POST['alamat_majikan']; ?><br />
	  No telefon: <?php echo $_POST['telefon_majikan']; ?>
</p></div>
	  <input type="submit" name="sah" id="sah" value="Sahkan pendaftaran" />
</form>
<?php
mysql_free_result($daftar);
?>