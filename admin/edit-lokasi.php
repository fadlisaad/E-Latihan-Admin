<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Edit location details.
 */
	error_reporting(0);
?>
<?php require_once('../Connections/ts_kursus.php'); ?>
<?php require_once('../login/auth.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE ts_tempat_kursus SET ts_tempat_alamat=%s, ts_tempat_pengurus=%s, ts_tempat_telefon=%s, ts_tempat_peta=%s, ts_tempat_email=%s, ts_tempat_year=%s WHERE ts_tempat_nama=%s",
                       GetSQLValueString($_POST['tempat_alamat'], "text"),
                       GetSQLValueString($_POST['tempat_pengurus'], "text"),
                       GetSQLValueString($_POST['tempat_telefon'], "text"),
                       GetSQLValueString($_POST['tempat_peta'], "text"),
                       GetSQLValueString($_POST['tempat_email'], "text"),
                       GetSQLValueString($_POST['year'], "int"),
                       GetSQLValueString($_POST['tempat_nama'], "text"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($updateSQL, $ts_kursus) or die(mysql_error());

  $updateGoTo = "list-lokasi.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_lokasi_detail = "-1";
if (isset($_GET['ts_tempat_ID'])) {
  $colname_lokasi_detail = $_GET['ts_tempat_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_lokasi_detail = sprintf("SELECT * FROM ts_tempat_kursus WHERE ts_tempat_ID = %s", GetSQLValueString($colname_lokasi_detail, "int"));
$lokasi_detail = mysql_query($query_lokasi_detail, $ts_kursus) or die(mysql_error());
$row_lokasi_detail = mysql_fetch_assoc($lokasi_detail);
$totalRows_lokasi_detail = mysql_num_rows($lokasi_detail);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/elatihan/ts/templates/admin_main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>MardiLMS - Admin</title>
<!-- InstanceEndEditable -->
<link rel="alternate" href="../rss.php" title="E-Learning RSS" type="application/rss+xml" />  
<link rel="stylesheet" type="text/css" href="css/theme1.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script>
   var StyleFile = "theme" + document.cookie.charAt(6) + ".css";
   document.writeln('<link rel="stylesheet" type="text/css" href="css/' + StyleFile + '">');
</script>
<script type="text/javascript" src="script/datepicker.js"></script>
<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "simple"
	});
</script>
<script type="text/javascript" src="../js/sorttable/sorttable.js"></script>
<script type="text/javascript" src="../js/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../js/scriptaculous/src/scriptaculous.js"></script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --><!-- InstanceParam name="head" type="boolean" value="true" --><!-- InstanceParam name="menu" type="boolean" value="true" --><!-- InstanceParam name="menu_right" type="boolean" value="true" --><!-- InstanceParam name="footer" type="boolean" value="true" -->
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:828px;
	top:19px;
	width:143px;
	height:128px;
	z-index:1;
}
-->
</style>
</head>

<body>
	<div id="container">
    <div id="header">
        <h2>MARDILMS (Kursus Umum) - Technical Services</h2>
      </div>
      <div id="topmenu">
            	<ul>
                <li class="current"><a href="index.php">Dashboard</a></li>
                <li><a href="list-kursus.php">Kursus</a></li>
               	<li><a href="list-peserta.php">Peserta</a></li>
                <li><a href="list-kategori.php">Kategori</a></li>
                <li><a href="list-lokasi.php">Lokasi</a></li>
                <li><a href="laporan/report_kursus.php">Laporan</a></li>
                <li><a href="../login/logout.php">Keluar</a></li>
        </ul>
          </div>
          <div id="top-panel"></div>
	
      <div id="wrapper"><!-- InstanceBeginEditable name="content" -->
            <div id="content"><br />
              <div id="box">
                <h3 id="adduser">Ubah Keterangan Lokasi </h3>
                <form name="form1" action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" id="form">
                  <fieldset id="personal">
                  <legend>Informasi</legend>
                  <label for="lastname">Nama Tempat  : </label>
                  <input name="tempat_nama" type="text" id="tempat_nama" value="<?php echo $row_lokasi_detail['ts_tempat_nama']; ?>" size="40" />
                  <br />
                  <label for="firstname">Pengurus : </label>
                  <input name="tempat_pengurus" type="text" id="tempat_pengurus" value="<?php echo $row_lokasi_detail['ts_tempat_pengurus']; ?>" size="40" />
                  <br />
                  <label for="email">E-mail : </label>
                  <input name="tempat_email" type="text" id="tempat_email" value="<?php echo $row_lokasi_detail['ts_tempat_email']; ?>" />
                  <br />
                  <label for="pass">Telefon : </label>
                  <input name="tempat_telefon" type="text" id="tempat_telefon" value="<?php echo $row_lokasi_detail['ts_tempat_telefon']; ?>" />
                  <br />
                  <label for="pass-2">Alamat : </label>
                  <textarea name="tempat_alamat" cols="40" id="tempat_alamat"><?php echo $row_lokasi_detail['ts_tempat_alamat']; ?></textarea>
                  <br />
                  <label for="pass-2">Peta : </label>
                  <input name="tempat_peta" type="file" id="tempat_peta" value="<?php echo $row_lokasi_detail['ts_tempat_peta']; ?>" />
                  <br />
                  <?php
						$errormsg = "Gagal! Sila cuba semula";
						$uploadmsg = "Peta sudah berjaya dimuat-naik";
						
						if(isset($_FILES['tempat_peta']['tmp_name'])){
							$target_path = "upload/";
							$target_path = $target_path . basename( $_FILES['tempat_peta']['name']); 
							if(move_uploaded_file($_FILES['tempat_peta']['tmp_name'], $target_path)) {
							echo "<em>".basename( $_FILES['tempat_peta']['name'])."</em> ".$uploadmsg;
							} else{
							echo "<em>".basename( $_FILES['tempat_peta']['name'])."</em> ".$errormsg;
							}
						}else{
						}
						?>
                  <input type="hidden" name="MAX_FILE_SIZE" value="1600000" />
                  <input type="hidden" name="MM_update" value="form1" />
                  <input name="year" type="hidden" id="year" value="2009" />
                  <input name="ts_tempat_ID" type="hidden" id="ts_tempat_ID" value="<?php echo $row_lokasi_detail['ts_tempat_ID']; ?>" />
                  </fieldset><div id="pager">
                  	<?php include "includes/button.html"; ?>
                </div>
                  </form>
                
              </div>
      
            </div>
            <!-- InstanceEndEditable -->
            <div id="sidebar">
              <ul>
                <li>
                  <h3><a href="#" class="house">Dashboard</a></h3>
                  <ul>
                    <li><a href="ringkasan.php" class="report">Ringkasan</a></li>
                    <li><a href="laporan/report_kursus.php" class="report_seo">Laporan</a></li>
                    <li><a href="finance.php" class="promotions">Kewangan</a></li>
                    <li><a href="#" class="search">Statistik</a></li>
                  </ul>
                </li>
                <li>
                  <h3><a href="#" class="folder_table">Kursus</a></h3>
                  <ul><?php require_once('../login/auth.php'); ?>
                  <?php if ($_SESSION['SESS_USERNAME']==admin){ 
				  	echo "<li><a href='../admin/tambah-kursus-admin.php' class='addorder'>Tambah Kursus</a></li>";
					} else {
					echo "<li><a href='../admin/tambah-kursus.php' class='addorder'>Tambah Kursus</a></li>";
					} ?>
                    <li><a href="tambah-kategori.php" class="addorder">Tambah Kategori</a></li>
                    <li><a href="tambah-lokasi.php" class="manage_page">Tambah Lokasi</a></li>
                    <li><a href="tambah-penaja.php" class="invoices">Tambah Penaja</a></li>
                  </ul>
                </li>
                <li>
                  <h3><a href="#" class="manage">Senarai</a></h3>
                  <ul>
                    <li><a href="list-kursus.php" class="addorder">Kursus</a></li>
                    <li><a href="list-penceramah.php" class="invoices">Penceramah</a></li>
                    <li><a href="list-topik.php" class="manage_page">Topik</a></li>
                    <li><a href="list-penaja.php" class="cart">Penaja</a></li>
                    <li><a href="list-kategori.php" class="folder">Kategori</a></li>
                    <li><a href="list-peserta.php" class="group">Peserta</a></li>
                    <li><a href="list-bayaran.php" class="promotions">Bayaran</a></li>
                    <li><a href="list-lokasi.php" class="manage_page">Lokasi</a></li>
                  </ul>
                </li>
                <li>
                  <h3><a href="#" class="user">Admin</a></h3>
                  <ul>
                  <?php if ($_SESSION['SESS_USERNAME']==admin){ 
				  	echo "<li><a href='../admin/tambah-admin.php' class='useradd'>Tambah Admin</a></li>";
                    echo "<li><a href='../admin/list.php' class='group'>Senarai Admin</a></li>";
					echo "<li><a href='../admin/cms.php' class='manage_page'>Artikel</a></li>";
					echo "<li><a href='../login/logout.php' class='online'>Log Keluar</a></li>";
					echo "<li><a href='?locale=ms_MY' class='online'>". _("Bahasa Melayu")."</a></li>";
					} else {
					echo "<li><a href='../admin/cms.php' class='manage_page'>Artikel</a></li>";
					echo "<li><a href='?locale=ms_MY' class='online'>". _("Bahasa Melayu")."</a></li>";
                    echo "<li><a href='../login/logout.php' class='online'>Log Keluar</a></li>";
					}
					?> 
                  </ul>
                </li>
              </ul>
            </div>
      </div>
          <div id="footer">
          <div id="credits">Hakcipta Terpelihara &copy; MARDILMS 2009-2011 | Tarikh kemaskini: <?php echo date("d/m/Y", time()); ?></div>
          
          <div id="styleswitcher">
            <ul>
              <li><a href="javascript: document.cookie='theme='; window.location.reload();" title="Default" id="defswitch">d</a></li>
              <li><a href="javascript: document.cookie='theme=1'; window.location.reload();" title="Blue" id="blueswitch">b</a></li>
              <li><a href="javascript: document.cookie='theme=2'; window.location.reload();" title="Green" id="greenswitch">g</a></li>
              <li><a href="javascript: document.cookie='theme=3'; window.location.reload();" title="Brown" id="brownswitch">b</a></li>
              <li><a href="javascript: document.cookie='theme=4'; window.location.reload();" title="Mix" id="mixswitch">m</a></li>
            </ul>
          </div>
          <br />
          
          </div>
</div></body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($lokasi_detail);
?>
