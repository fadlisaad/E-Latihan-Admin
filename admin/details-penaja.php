<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Details for sponsor list.
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

$colname_vendor_details = "-1";
if (isset($_GET['kursus_vendor_ID'])) {
  $colname_vendor_details = $_GET['kursus_vendor_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_vendor_details = sprintf("SELECT ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_kod, ts_vendor.kursus_vendor_nama, ts_vendor.kursus_vendor_personel, ts_vendor.kursus_vendor_telefon, ts_vendor.kursus_vendor_fax, ts_vendor.kursus_vendor_email, ts_vendor.kursus_vendor_alamat, ts_vendor.kursus_vendor_year, ts_kursus.ts_kursus_id FROM ts_vendor, ts_kursus WHERE kursus_vendor_ID = %s AND ts_vendor.kursus_vendor_nama=ts_kursus.ts_kursus_vendor", GetSQLValueString($colname_vendor_details, "int"));
$vendor_details = mysql_query($query_vendor_details, $ts_kursus) or die(mysql_error());
$row_vendor_details = mysql_fetch_assoc($vendor_details);
$totalRows_vendor_details = mysql_num_rows($vendor_details);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_list_peserta = "SELECT COUNT(ts_peserta_status) FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status GROUP BY ts_peserta_status";
$list_peserta = mysql_query($query_list_peserta, $ts_kursus) or die(mysql_error());
$row_list_peserta = mysql_fetch_assoc($list_peserta);
$totalRows_list_peserta = mysql_num_rows($list_peserta);

isset($startRow_vendor_details)? $orderNum=$startRow_vendor_details:$orderNum=0;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!-- InstanceBegin template="/Templates/Admin_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="en" />
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/reset.css" />
<!-- RESET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/main.css" />
<!-- MAIN STYLE SHEET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/2col.css" title="2col" />
<!-- DEFAULT: 2 COLUMNS -->
<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../css/1col.css" title="1col" />
<!-- ALTERNATE: 1 COLUMN -->
<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]-->
<!-- MSIE6 -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/style.css" />
<!-- GRAPHIC THEME -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/mystyle.css" />
<!-- FAVICON -->
<link href="http://elearn.mardi.gov.my/templates/jakyaniteii/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!-- DATEPICKER -->
<link rel="stylesheet" type="text/css" href="../js/datepicker.css">
<!-- JAVASCRIPTS -->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/switcher.js"></script>
<script type="text/javascript" src="../js/toggle.js"></script>
<script type="text/javascript" src="../js/ui.core.js"></script>
<script type="text/javascript" src="../js/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
</script>
<script type="text/javascript" src="../js/datepicker.js"></script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Kategori Kursus</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --><!-- InstanceParam name="sidebar" type="boolean" value="true" --><!-- InstanceParam name="footer" type="boolean" value="true" --><!-- InstanceParam name="header" type="boolean" value="true" -->
</head>

<body>
<div id="main">
	<!-- Tray -->
	<div id="tray" class="box">
		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
            <a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column">
            <img src="../design/switcher-1col.gif" alt="1 Column" />
            </a><a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns">
            <img src="../design/switcher-2col.gif" alt="2 Columns" /></a></span>

			E-Latihan: <strong>Program Kursus dan Latihan Teknikal</strong></p>

	  <p class="f-right">Pengguna: <?php echo $_SESSION['SESS_FULLNAME'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href="../login/logout.php" id="logout">Log keluar</a></strong></p>

  </div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	
	<div id="menu" class="box">      
      <ul class="box">
        <li><div class="buttons"><a href="tambah-kursus.php"><img src="img/icons/add.png" alt=""/>Kursus</a></div></li>
        <li><div class="buttons"><a href="tambah-lokasi.php"><img src="img/icons/add.png" alt=""/>Lokasi</a></div></li>
        <li><div class="buttons"><a href="tambah-kategori.php"><img src="img/icons/add.png" alt=""/>Kluster</a></div></li>
        <li><div class="buttons"><a href="tambah-admin.php"><img src="img/icons/add.png" alt=""/>Penyelaras</a></div></li>
      </ul>
    </div>

	
	<!-- /header -->

<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		
		<div id="aside" class="box">
          <ul class="box">
          <li id="submenu-active"><a href="index.php">Halaman Utama</a></li>
			<li id="submenu-active"><a href="#">Kursus</a>
                <ul>
                	<li><a href="list-kategori.php">Senarai Kluster</a></li>
                  <li><a href="list-kursus.php">Senarai Kursus</a></li>
                  <li><a href="list.php">Senarai Penyelaras</a></li>
                  <li><a href="list-peserta.php">Senarai Peserta</a></li>
                  <li><a href="list-penceramah.php">Senarai Penceramah</a></li>
                  <li><a href="list-topik.php">Senarai Topik</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Kewangan</a>
                <ul>
                	<li><a href="list-bayaran.php">Honorarium</a></li>
                    <li><a href="list-bayaran-kursus.php">Penyata Perbelanjaan</a></li>
                    <li><a href="list-bayaran-pendahuluan.php">Bayaran Pendahuluan</a></li>
                    <li><a href="list-bayaran-invoice.php">Invois</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Rekod Kursus</a>
                <ul>
                	<li><a href="analisis-kursus.php">Penilaian Kursus</a></li>
                    <li><a href="analisis-penceramah.php">Penilaian Penceramah</a></li>
                    <li><a href="analisis-peserta.php">Analisis Peserta</a></li>
                    <li><a href="analisis-bayaran.php">Analisis Kluster</a></li>
                    <li><a href="analisis-bulanan.php">Analisis Bulanan</a></li>
                </ul>
            </li>
            </ul>
	    </div>
		
		<!-- /aside -->

    <hr class="noscreen" />

		<!-- Content (Right Column) -->
		<!-- InstanceBeginEditable name="content" -->
            <div id="content">
              <h3>Senarai kursus dibawah kategori <?php echo $row_vendor_details['kursus_vendor_nama']; ?></h3>
              <form action="<?php echo $editFormAction; ?>" method="post" name="vendor_details" id="vendor_details">
                <table width="100%" class="nostyle">
                  <tr>
                    <td width="20%"><strong>Nama</strong></td>
                    <td><?php echo $row_vendor_details['kursus_vendor_nama']; ?></td>
                  </tr>
                  <tr>
                    <td width="20%"><strong>Pengurus</strong></td>
                    <td><?php echo $row_vendor_details['kursus_vendor_personel']; ?></td>
                  </tr>
                  <tr>
                    <td width="20%"><strong>Alamat</strong></td>
                    <td><?php echo $row_vendor_details['kursus_vendor_alamat']; ?></td>
                  </tr>
                  <tr>
                    <td width="20%"><strong>Telefon</strong></td>
                    <td><?php echo $row_vendor_details['kursus_vendor_telefon']; ?></td>
                  </tr>
                  <tr>
                    <td width="20%"><strong>Fax</strong></td>
                    <td><?php echo $row_vendor_details['kursus_vendor_fax']; ?></td>
                  </tr>
                  <tr>
                    <td width="20%"><strong>E-mail</strong></td>
                    <td><?php echo $row_vendor_details['kursus_vendor_email']; ?></td>
                  </tr>
                </table>
              </form>
              <table width="100%">
                <thead>
                  <tr>
                    <th width="40">Bil</th>
                    <th>Nama Kursus</th>
                    <th>Kod</th>
                  </tr>
                </thead>
                <tbody>
                  <?php do { ?>
                  <tr>
                    <td class="t-center"><?php echo ++$orderNum; ?></td>
                    <td><a href="list-peserta-kursus.php?ts_kursus_id=<?php echo $row_vendor_details['ts_kursus_id']; ?>"><?php echo $row_vendor_details['ts_kursus_nama']; ?></a></td>
                    <td class="t-center"><?php echo $row_vendor_details['ts_kursus_kod']; ?></td>
                  </tr>
                    <?php } while ($row_vendor_details = mysql_fetch_assoc($vendor_details)); ?>
                </tbody>
              </table>
                  <div id="pager"><?php include "includes/back.html"; ?></div>
      </div><!-- InstanceEndEditable -->
		<!-- /content -->
	</div> 
<!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	
	<div id="footer" class="box">
      <p class="f-left"><span class="t-left">&copy; 2010 Hakcipta Terpelihara E-Latihan</span></p>
      <p class="f-right"><span class="t-left">Pusat Kursus dan Latihan Teknikal, MARDI</span></p>
	  </div>
  
	<!-- /footer -->
</div> 
<!-- /main -->

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($vendor_details);

mysql_free_result($list_peserta);
?>