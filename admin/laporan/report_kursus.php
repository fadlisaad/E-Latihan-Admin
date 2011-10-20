<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script for denying access to the backend.
 */
	error_reporting(0);
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

$maxRows_count_kursus = 5;
$pageNum_count_kursus = 0;
if (isset($_GET['pageNum_count_kursus'])) {
  $pageNum_count_kursus = $_GET['pageNum_count_kursus'];
}
$startRow_count_kursus = $pageNum_count_kursus * $maxRows_count_kursus;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_count_kursus = "SELECT ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_kategori,COUNT(ts_kursus_id) FROM ts_kursus GROUP BY ts_kursus_kategori ORDER BY COUNT(ts_kursus_id) desc";
$query_limit_count_kursus = sprintf("%s LIMIT %d, %d", $query_count_kursus, $startRow_count_kursus, $maxRows_count_kursus);
$count_kursus = mysql_query($query_limit_count_kursus, $ts_kursus) or die(mysql_error());
$row_count_kursus = mysql_fetch_assoc($count_kursus);

if (isset($_GET['totalRows_count_kursus'])) {
  $totalRows_count_kursus = $_GET['totalRows_count_kursus'];
} else {
  $all_count_kursus = mysql_query($query_count_kursus);
  $totalRows_count_kursus = mysql_num_rows($all_count_kursus);
}
$totalPages_count_kursus = ceil($totalRows_count_kursus/$maxRows_count_kursus)-1;

$maxRows_count_penaja = 5;
$pageNum_count_penaja = 0;
if (isset($_GET['pageNum_count_penaja'])) {
  $pageNum_count_penaja = $_GET['pageNum_count_penaja'];
}
$startRow_count_penaja = $pageNum_count_penaja * $maxRows_count_penaja;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_count_penaja = "SELECT ts_vendor.kursus_vendor_nama, ts_kursus.ts_kursus_vendor,COUNT(kursus_vendor_nama) FROM ts_vendor, ts_kursus WHERE ts_kursus.ts_kursus_vendor=ts_vendor.kursus_vendor_nama GROUP BY kursus_vendor_nama";
$query_limit_count_penaja = sprintf("%s LIMIT %d, %d", $query_count_penaja, $startRow_count_penaja, $maxRows_count_penaja);
$count_penaja = mysql_query($query_limit_count_penaja, $ts_kursus) or die(mysql_error());
$row_count_penaja = mysql_fetch_assoc($count_penaja);

if (isset($_GET['totalRows_count_penaja'])) {
  $totalRows_count_penaja = $_GET['totalRows_count_penaja'];
} else {
  $all_count_penaja = mysql_query($query_count_penaja);
  $totalRows_count_penaja = mysql_num_rows($all_count_penaja);
}
$totalPages_count_penaja = ceil($totalRows_count_penaja/$maxRows_count_penaja)-1;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_report_admin = "SELECT ts_admin_ID, ts_admin_nama FROM ts_admin ORDER BY ts_admin_ID ASC";
$report_admin = mysql_query($query_report_admin, $ts_kursus) or die(mysql_error());
$row_report_admin = mysql_fetch_assoc($report_admin);
$totalRows_report_admin = mysql_num_rows($report_admin);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_popular = "SELECT ts_peserta.ts_peserta_status, ts_kursus.ts_kursus_id,COUNT(ts_peserta_status), ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_bil_max FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status GROUP BY ts_peserta_status ORDER BY COUNT(ts_peserta_status) DESC";
$popular = mysql_query($query_popular, $ts_kursus) or die(mysql_error());
$row_popular = mysql_fetch_assoc($popular);
$totalRows_popular = mysql_num_rows($popular);
isset($startRow_popular)? $orderNum=$startRow_popular:$orderNum=0;
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
<title>Laporan Kursus</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<!-- InstanceEndEditable --><!-- InstanceParam name="sidebar" type="boolean" value="true" --><!-- InstanceParam name="footer" type="boolean" value="true" --><!-- InstanceParam name="header" type="boolean" value="true" -->
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
            <div id="content">

                <h3 class="reallynow">
                    <span>Laporan Kursus</span>
                    <a href="#" title="Cetak" class="printer" onclick="MM_openBrWindow('print_report_kursus.php','LaporanKursus','scrollbars=yes')">Cetak</a>
                    <a href="#" class="excel" title="Export to CSV">CSV</a>
                    <a href="#" class="pdf" title="Export to PDF">PDF</a>
                    <br />
                </h3>
              <p class="youhave">Berikut adalah laporan untuk keseluruhan kursus sepanjang tahun <?php echo date('Y'); ?>. Untuk mencetak laporan, klik pada ikon Cetak</p>  
              

                <h3>Jumlah Peserta</h3>
                <table width="100%" class="sortable">
                  <thead>
                    <tr>
                      <th class="a-left">Bil</th>
                   	    <th class="a-left">Tajuk</th>
                      <th width="100" nowrap="nowrap">Berdaftar</th>
                      <th width="100" nowrap="nowrap">Kuota</th>
                      <th width="100" nowrap="nowrap">% berdaftar</th>
				    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                    <?php 
							$a = $row_popular['COUNT(ts_peserta_status)'];
							$b = $row_popular['ts_kursus_bil_max'];
							$total+= $a;
							$max+= $b;
							$percentage=($a/$b)*100;
							$avg=($total/$max)*100;
						?>
                      <tr>
                        <td><?php echo ++$orderNum; ?></td>
                        <td><?php echo chop($row_popular['ts_kursus_nama']); ?></td>
                        <td width="100" class="a-center"><?php echo $row_popular['COUNT(ts_peserta_status)']; ?></td>
                        <td width="100" class="a-center"><?php echo $row_popular['ts_kursus_bil_max']; ?></td>
                        <td width="100" class="a-center"><?php echo number_format($percentage,3); ?></td>
                    </tr>
                    <?php } while ($row_popular = mysql_fetch_assoc($popular)); ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"><strong>Jumlah Peserta</strong></td>
                      <td class="a-center"><strong><?php echo $total; ?></strong></td>
                      <td class="a-center"><strong><?php echo $max; ?></strong></td>
                      <td class="a-center"><strong><?php echo number_format($avg,3); ?></strong></td>
                    </tr>
                  </tfoot>
                </table>
                  
              <h3>Carta Pai</h3>
                <p><!-- ampie script-->
                  <script type="text/javascript" src="../../ampie/swfobject.js"></script>
                  <!-- pie 1-->
              <div id="flashcontent1">
                      <strong>You need to upgrade your Flash Player</strong>              </div>
              <script type="text/javascript">
						// <![CDATA[		
						var so = new SWFObject("../../ampie/ampie.swf", "ampie1", "500", "600", "4", "#FFFFFF");
						so.addVariable("path", "../../ampie/");
						so.addVariable("settings_file", encodeURIComponent("../../ampie/kategori_settings.xml"));
						so.addVariable("data_file", encodeURIComponent("../../ampie/report_peserta.php"));
						so.write("flashcontent1");
						// ]]>
					</script>
              <!-- end of ampie script -->
              </p>            
              
                <h3>Graf</h3>
                  <p><!-- ampie script-->
                    <script type="text/javascript" src="../../ampie/swfobject.js"></script>
                    <!-- pie 1-->
                <div id="flashcontent2">
                        <strong>You need to upgrade your Flash Player</strong>                </div>
              <script type="text/javascript">
						// <![CDATA[		
						var so = new SWFObject("../../amcolumn/amcolumn.swf", "amcolumn", "800", "900", "4", "#FFFFFF");
						so.addVariable("path", "../../amcolumn/");
						so.addVariable("settings_file", encodeURIComponent("../../amcolumn/amcolumn_settings.xml"));
						so.addVariable("data_file", encodeURIComponent("../../amcolumn/report_peserta.php"));
						so.write("flashcontent2");
						// ]]>
					</script>
                <!-- end of ampie script -->
                </p>            
              <br />
          <div class="buttons"><a href="javascript:history.go(-1)">
          <img src="../img/icons/arrow_undo.png" alt=""/>Kembali</a></div>
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
mysql_free_result($count_kursus);

mysql_free_result($count_penaja);

mysql_free_result($report_admin);

mysql_free_result($popular);
?>
