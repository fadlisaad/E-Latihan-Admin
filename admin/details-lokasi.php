<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Details of location of course to be held.
 */
	error_reporting(0);
?>
<?php require_once('../Connections/ts_kursus.php'); ?>
<?php require_once('../login/auth.php'); ?>
<?php
$colname_lokasi_detail = "-1";
if (isset($_GET['ts_tempat_ID'])) {
  $colname_lokasi_detail = (get_magic_quotes_gpc()) ? $_GET['ts_tempat_ID'] : addslashes($_GET['ts_tempat_ID']);
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_lokasi_detail = sprintf("SELECT * FROM ts_tempat_kursus WHERE ts_tempat_ID = %s", $colname_lokasi_detail);
$lokasi_detail = mysql_query($query_lokasi_detail, $ts_kursus) or die(mysql_error());
$row_lokasi_detail = mysql_fetch_assoc($lokasi_detail);
$totalRows_lokasi_detail = mysql_num_rows($lokasi_detail);
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
<title>e-Latihan - Lokasi</title>
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
             <h3>Lokasi : <?php echo $row_lokasi_detail['ts_tempat_nama']; ?></h3>
             <fieldset>
                <legend>Keterangan</legend>
                <table width="100%" class="nostyle">
                  <tr>
                    <td width="20%"><strong>Nama</strong></td>
                    <td><?php echo $row_lokasi_detail['ts_tempat_nama']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Alamat</strong></td>
                    <td><?php echo $row_lokasi_detail['ts_tempat_alamat']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Pengurus</strong></td>
                    <td><?php echo $row_lokasi_detail['ts_tempat_pengurus']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Telefon</strong></td>
                    <td><?php echo $row_lokasi_detail['ts_tempat_telefon']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>E-mail</strong></td>
                    <td><?php echo $row_lokasi_detail['ts_tempat_email']; ?></td>
                  </tr>
                  <tr>
                    <td class="va-top"><strong>Peta</strong></td>
                    <td><a href="../upload/<?php echo $row_lokasi_detail['ts_tempat_peta']; ?>"><img src="../upload/<?php echo $row_lokasi_detail['ts_tempat_peta']; ?>" alt="-Tiada Peta-" name="test" width="100" border="0" id="test" /></a></td>
                  </tr>
                </table>
              </fieldset>
              <div><?php include "includes/back.html"; ?></div>
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
mysql_free_result($lokasi_detail);
?>
