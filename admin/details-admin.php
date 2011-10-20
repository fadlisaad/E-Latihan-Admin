<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Keterangan admin kursus.
 */
error_reporting(0);
require_once('../login/auth.php');
?>
<?php require_once('../Connections/ts_kursus.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_admin = 10;
$pageNum_admin = 0;
if (isset($_GET['pageNum_admin'])) {
  $pageNum_admin = $_GET['pageNum_admin'];
}
$startRow_admin = $pageNum_admin * $maxRows_admin;

$colname_admin = "-1";
if (isset($_GET['ts_admin_ID'])) {
  $colname_admin = $_GET['ts_admin_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_admin = sprintf("SELECT * FROM ts_admin WHERE ts_admin.ts_admin_ID = %s", GetSQLValueString($colname_admin, "int"));
$query_limit_admin = sprintf("%s LIMIT %d, %d", $query_admin, $startRow_admin, $maxRows_admin);
$admin = mysql_query($query_limit_admin, $ts_kursus) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);

if (isset($_GET['totalRows_admin'])) {
  $totalRows_admin = $_GET['totalRows_admin'];
} else {
  $all_admin = mysql_query($query_admin);
  $totalRows_admin = mysql_num_rows($all_admin);
}
$totalPages_admin = ceil($totalRows_admin/$maxRows_admin)-1;

$maxRows_kursus = 10;
$pageNum_kursus = 0;
if (isset($_GET['pageNum_kursus'])) {
  $pageNum_kursus = $_GET['pageNum_kursus'];
}
$startRow_kursus = $pageNum_kursus * $maxRows_kursus;

$colname_kursus = "-1";
if (isset($_GET['ts_admin_ID'])) {
  $colname_kursus = $_GET['ts_admin_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus = sprintf("SELECT ts_kursus.ts_kursus_kod, ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_id FROM ts_kursus WHERE ts_kursus.ts_kursus_admin=%s", GetSQLValueString($colname_kursus, "int"));
$query_limit_kursus = sprintf("%s LIMIT %d, %d", $query_kursus, $startRow_kursus, $maxRows_kursus);
$kursus = mysql_query($query_limit_kursus, $ts_kursus) or die(mysql_error());
$row_kursus = mysql_fetch_assoc($kursus);

if (isset($_GET['totalRows_kursus'])) {
  $totalRows_kursus = $_GET['totalRows_kursus'];
} else {
  $all_kursus = mysql_query($query_kursus);
  $totalRows_kursus = mysql_num_rows($all_kursus);
}
$totalPages_kursus = ceil($totalRows_kursus/$maxRows_kursus)-1;

$queryString_kursus = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_kursus") == false && 
        stristr($param, "totalRows_kursus") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_kursus = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_kursus = sprintf("&totalRows_kursus=%d%s", $totalRows_kursus, $queryString_kursus);

isset($startRow_kursus)? $orderNum=$startRow_kursus:$orderNum=0;

$queryString_admin = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_admin") == false && 
        stristr($param, "totalRows_admin") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_admin = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_admin = sprintf("&totalRows_admin=%d%s", $totalRows_admin, $queryString_admin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<title>Keterangan Penyelaras</title>
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
        <div class="tabs box">
            <ul>
              <li><a href="#tab01"><span>Senarai Kursus</span></a></li>
              <li><a href="#tab02"><span>Biodata Penyelaras</span></a></li>
            </ul>
	      </div>
		<div id="tab02">
          <h3><?php echo $row_admin['ts_admin_nama']; ?></h3>
          <table width="100%" class="nostyle">
            <tr>
              <td width="13%"><strong>Login ID</strong></td>
              <td width="87%"><?php echo $row_admin['ts_admin_username']; ?></td>
            </tr>
            <tr>
              <td><strong>Telefon</strong></td>
              <td><?php echo $row_admin['ts_admin_phone']; ?></td>
            </tr>
            <tr>
              <td><strong>E-mail</strong></td>
              <td><?php echo $row_admin['ts_admin_email']; ?></td>
            </tr>
          </table>
          <br />
          <div class="buttons"><a href="javascript:history.go(-1)">
          <img src="img/icons/arrow_undo.png" alt=""/>Kembali</a></div>
          </div>
        
        <div id="tab01">
          <?php if ($totalRows_kursus == 0) { // Show if recordset empty ?>
          <p class="msg info">Tiada kursus dibawah seliaan</p>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_kursus > 0) { // Show if recordset not empty ?>
            <h3>Senarai Kursus</h3>
            <table width="100%" class="sortable">
              <thead>
                <tr>
                  <th width="15">Bil</th>
                  <th>Kod Kursus </th>
                  <th>Tajuk Kursus </th>
                </tr>
              </thead>
              <tbody>
                <?php do { ?>
                  <tr class="a-center">
                    <td width="15" class="a-center"><?php echo ++$orderNum; ?></td>
                    <td><?php echo $row_kursus['ts_kursus_kod']; ?></td>
                    <td class="a-left"><a href="list-peserta-kursus.php?ts_kursus_id=<?php echo $row_kursus['ts_kursus_id']; ?>"><?php echo $row_kursus['ts_kursus_nama']; ?></a></td>
                  </tr>
                  <?php } while ($row_kursus = mysql_fetch_assoc($kursus)); ?>
              </tbody>
            </table>
		  
        </div>
          
<div class="fix"></div>
          <div><a href="<?php printf("%s?pageNum_kursus=%d%s", $currentPage, max(0, $pageNum_kursus - 1), $queryString_kursus); ?>"><img src="img/icons/arrow_left.gif" alt="left" width="16" height="16" /></a><a href="<?php printf("%s?pageNum_kursus=%d%s", $currentPage, min($totalPages_kursus, $pageNum_kursus + 1), $queryString_kursus); ?>"><img src="img/icons/arrow_right.gif" alt="right" width="16" height="16" /></a>Rekod <?php echo ($startRow_kursus + 1) ?> daripada <?php echo min($startRow_kursus + $maxRows_kursus, $totalRows_kursus) ?> rekod  | Jumlah rekod ialah <strong><?php echo $totalRows_kursus ?></strong></div>
          <?php } // Show if recordset not empty ?>
          <br />
          <div class="buttons"><a href="javascript:history.go(-1)">
          <img src="img/icons/arrow_undo.png" alt=""/>Kembali</a></div>
          
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
mysql_free_result($admin);

mysql_free_result($kursus);
?>
