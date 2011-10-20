<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Laporan penamatan kursus.
 */
error_reporting(0);
require_once('../../login/auth.php');
?>
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

$colname_kursus = "-1";
if (isset($_GET['kursus_id'])) {
  $colname_kursus = $_GET['kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus = sprintf("SELECT ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_kod, ts_kursus.ts_kursus_kategori, ts_kursus.ts_kursus_lokasi, ts_kursus.ts_kursus_vendor, ts_kursus.ts_kursus_harga, ts_kursus.ts_kursus_tarikh_mula, ts_kursus.ts_kursus_tarikh_tamat FROM ts_kursus WHERE ts_kursus.ts_kursus_id=%s", GetSQLValueString($colname_kursus, "int"));
$kursus = mysql_query($query_kursus, $ts_kursus) or die(mysql_error());
$row_kursus = mysql_fetch_assoc($kursus);
$totalRows_kursus = mysql_num_rows($kursus);

$colname_pendahuluan = "-1";
if (isset($_GET['kursus_id'])) {
  $colname_pendahuluan = $_GET['kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_pendahuluan = sprintf("SELECT * FROM ts_advance WHERE ts_advance_kursus_id = %s", GetSQLValueString($colname_pendahuluan, "int"));
$pendahuluan = mysql_query($query_pendahuluan, $ts_kursus) or die(mysql_error());
$row_pendahuluan = mysql_fetch_assoc($pendahuluan);
$totalRows_pendahuluan = mysql_num_rows($pendahuluan);

$colname_peserta = "-1";
if (isset($_GET['kursus_id'])) {
  $colname_peserta = $_GET['kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_peserta = sprintf("SELECT COUNT(id) as peserta FROM ts_invoice WHERE kursus_id = %s GROUP BY kursus_id", GetSQLValueString($colname_peserta, "int"));
$peserta = mysql_query($query_peserta, $ts_kursus) or die(mysql_error());
$row_peserta = mysql_fetch_assoc($peserta);
$totalRows_peserta = mysql_num_rows($peserta);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!-- InstanceBegin template="/Templates/Admin_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="en" />
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/reset.css" />
<!-- RESET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/main.css" />
<!-- MAIN STYLE SHEET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/2col.css" title="2col" />
<!-- DEFAULT: 2 COLUMNS -->
<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../../css/1col.css" title="1col" />
<!-- ALTERNATE: 1 COLUMN -->
<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]-->
<!-- MSIE6 -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/style.css" />
<!-- GRAPHIC THEME -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/mystyle.css" />
<!-- FAVICON -->
<link href="http://elearn.mardi.gov.my/templates/jakyaniteii/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!-- DATEPICKER -->
<link rel="stylesheet" type="text/css" href="../../js/datepicker.css">
<!-- JAVASCRIPTS -->
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/switcher.js"></script>
<script type="text/javascript" src="../../js/toggle.js"></script>
<script type="text/javascript" src="../../js/ui.core.js"></script>
<script type="text/javascript" src="../../js/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
</script>
<script type="text/javascript" src="../../js/datepicker.js"></script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Laporan Penamatan Kursus</title>
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
            <img src="../../design/switcher-1col.gif" alt="1 Column" />
            </a><a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns">
            <img src="../../design/switcher-2col.gif" alt="2 Columns" /></a></span>

			E-Latihan: <strong>Program Kursus dan Latihan Teknikal</strong></p>

	  <p class="f-right">Pengguna: <?php echo $_SESSION['SESS_FULLNAME'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href="../../login/logout.php" id="logout">Log keluar</a></strong></p>

  </div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	
	<div id="menu" class="box">      
      <ul class="box">
        <li><div class="buttons"><a href="tambah-kursus.php"><img src="../img/icons/add.png" alt=""/>Kursus</a></div></li>
        <li><div class="buttons"><a href="tambah-lokasi.php"><img src="../img/icons/add.png" alt=""/>Lokasi</a></div></li>
        <li><div class="buttons"><a href="tambah-kategori.php"><img src="../img/icons/add.png" alt=""/>Kluster</a></div></li>
        <li><div class="buttons"><a href="tambah-admin.php"><img src="../img/icons/add.png" alt=""/>Penyelaras</a></div></li>
      </ul>
    </div>

	
	<!-- /header -->

<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		
		<div id="aside" class="box">
          <ul class="box">
          <li id="submenu-active"><a href="../index.php">Halaman Utama</a></li>
			<li id="submenu-active"><a href="#">Kursus</a>
                <ul>
                	<li><a href="../list-kategori.php">Senarai Kluster</a></li>
                  <li><a href="../list-kursus.php">Senarai Kursus</a></li>
                  <li><a href="../list.php">Senarai Penyelaras</a></li>
                  <li><a href="../list-peserta.php">Senarai Peserta</a></li>
                  <li><a href="../list-penceramah.php">Senarai Penceramah</a></li>
                  <li><a href="../list-topik.php">Senarai Topik</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Kewangan</a>
                <ul>
                	<li><a href="../list-bayaran.php">Honorarium</a></li>
                    <li><a href="../list-bayaran-kursus.php">Penyata Perbelanjaan</a></li>
                    <li><a href="../list-bayaran-pendahuluan.php">Bayaran Pendahuluan</a></li>
                    <li><a href="../list-bayaran-invoice.php">Invois</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Rekod Kursus</a>
                <ul>
                	<li><a href="../analisis-kursus.php">Penilaian Kursus</a></li>
                    <li><a href="../analisis-penceramah.php">Penilaian Penceramah</a></li>
                    <li><a href="../analisis-peserta.php">Analisis Peserta</a></li>
                    <li><a href="../analisis-bayaran.php">Analisis Kluster</a></li>
                    <li><a href="../analisis-bulanan.php">Analisis Bulanan</a></li>
                </ul>
            </li>
            </ul>
	    </div>
		
		<!-- /aside -->

    <hr class="noscreen" />

		<!-- Content (Right Column) -->
		<!-- InstanceBeginEditable name="content" -->
		<div id="content" class="box"><!-- Headings -->
        <h2 class="t-center">Laporan Penamatan Kursus</h2>
		  <table width="100%">
            <tr>
              <td><strong>Kod Kursus</strong></td>
              <td colspan="3"><?php echo $row_kursus['ts_kursus_kod']; ?></td>
            </tr>
            <tr>
              <td><strong>Tajuk Kursus</strong></td>
              <td colspan="3"><?php echo $row_kursus['ts_kursus_nama']; ?></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td><strong>Agensi</strong></td>
              <td>&nbsp;</td>
              <td><strong>Pakej</strong></td>
              <td><?php echo $row_kursus['ts_kursus_vendor']; ?></td>
            </tr>
            <tr>
              <td><strong>Tarikh</strong></td>
              <td><?php 
			  if ($row_kursus['ts_kursus_tarikh_mula'] == '0000-00-00'){
					echo 'Tiada'; 
				}
				else {
					echo date("d/m/Y",strtotime($row_kursus['ts_kursus_tarikh_mula'])); ?> - <?php echo date("d/m/Y",strtotime($row_kursus['ts_kursus_tarikh_tamat'])); 
					}
					?></td>
              <td><strong>Tempoh</strong></td>
              <td><?php $total = $row_kursus['ts_kursus_tarikh_tamat'] - $row_kursus['ts_kursus_tarikh_mula']; echo $total; ?> hari</td>
            </tr>
            <tr>
              <td><strong>Tempat</strong></td>
              <td colspan="3"><?php echo $row_kursus['ts_kursus_lokasi']; ?></td>
            </tr>
            <tr>
              <th colspan="4" class="t-center">Kewangan (RM)</th>
            </tr>
            <tr>
              <td>Jumlah terimaan pakej/individu</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td class="t-right"><?php echo number_format(($row_peserta['peserta']*$row_kursus['ts_kursus_harga']),2); ?></td>
            </tr>
            <tr>
              <th colspan="4">Pendahuluan pelbagai</th>
            </tr>
            <tr>
              <td>Jumlah pendahuluan</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td class="t-right"><?php echo number_format($row_pendahuluan['ts_advance_jumlah'],2); ?></td>
            </tr>
            <tr>
              <td>Tarikh mohon pendahuluan</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td class="t-right"><?php 
			  	if ($row_pendahuluan['ts_advance_tarikh_ambil'] == NULL){
					echo 'Tiada'; 
				}
				else {
					echo date("d/m/Y",strtotime($row_pendahuluan['ts_advance_tarikh_ambil'])); 
					}
					?></td>
            </tr>
            <tr>
              <td>Jumlah pulangan pendahuluan</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td class="t-right"><?php echo number_format($row_pendahuluan['ts_advance_jumlah'],2); ?></td>
            </tr>
            <tr>
              <td>Tarikh pulang pendahuluan</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td class="t-right"><?php 
			  if ($row_pendahuluan['ts_advance_tarikh_kembali'] == NULL){
					echo 'Tiada'; 
				}
				else {
					echo date("d/m/Y",strtotime($row_pendahuluan['ts_advance_tarikh_kembali'])); 
					}
					?></td>
            </tr>
            <tr>
              <th colspan="4">Honorarium</th>
            </tr>
            <tr>
              <td>Bil. penceramah</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td class="t-right"></td>
            </tr>
            <tr>
              <td>Bil. fasilitator</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td class="t-right">&nbsp;</td>
            </tr>
            <tr>
              <td>Jumlah honorarium</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td class="t-right">&nbsp;</td>
            </tr>
            <tr>
              <th colspan="4">TNT</th>
            </tr>
            <tr>
              <td>Penginapan</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Pengangkutan</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Kos-kos lain</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Jumlah perbelanjaan</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Pendapatan bersih</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <th colspan="4">Isu/maklum balas</th>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <div class="fix"></div>
          <div class="buttons"><a href="javascript:history.go(-1)">
          <img src="../img/icons/arrow_undo.png" alt=""/>Kembali</a></div>
		  <!-- Table (TABLE) -->
		</div>
		<!-- InstanceEndEditable -->
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
mysql_free_result($kursus);
mysql_free_result($pendahuluan);
mysql_free_result($peserta);
?>