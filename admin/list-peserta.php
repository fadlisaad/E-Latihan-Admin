<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Senarai peserta Kursus.
 */
error_reporting(0);

require_once('../login/auth.php');
require_once('../Connections/ts_kursus.php');

// get year
if (isset($_GET['id'])) {
	$thisyear	= $_GET['id'];
	}
else {
	$thisyear	= date('Y');
	}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list = 200;
$pageNum_list = 0;
if (isset($_GET['pageNum_list'])) {
  $pageNum_list = $_GET['pageNum_list'];
}
$startRow_list = $pageNum_list * $maxRows_list;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_list = "SELECT ts_invoice.kursus_id, ts_kursus.ts_kursus_kod, COUNT(ts_invoice.peserta_id) AS peserta, ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_vendor, ts_kursus.ts_kursus_bil_max FROM ts_invoice, ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_invoice.kursus_id AND ts_invoice.peserta_id = ts_peserta.ts_peserta_ID AND ts_kursus.ts_kursus_year = ".$thisyear." GROUP BY ts_invoice.kursus_id ORDER BY ts_kursus.ts_kursus_vendor";
$query_limit_list = sprintf("%s LIMIT %d, %d", $query_list, $startRow_list, $maxRows_list);
$list = mysql_query($query_limit_list, $ts_kursus) or die(mysql_error());
$row_list = mysql_fetch_assoc($list);

if (isset($_GET['totalRows_list'])) {
  $totalRows_list = $_GET['totalRows_list'];
} else {
  $all_list = mysql_query($query_list);
  $totalRows_list = mysql_num_rows($all_list);
}
$totalPages_list = ceil($totalRows_list/$maxRows_list)-1;

isset($startRow_list)? $orderNum=$startRow_list:$orderNum=0;

$queryString_list = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list") == false && 
        stristr($param, "totalRows_list") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list = sprintf("&totalRows_list=%d%s", $totalRows_list, $queryString_list);

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
<title>Bilangan Peserta</title>
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
			<h3>Bilangan Peserta (Keseluruhan) bagi tahun <?php echo $thisyear; ?></h3>
			<div class="buttons"><a href="#"><img src="img/icons/magnifier.png" alt=""/>Pilih tahun&nbsp;&raquo;</a></div>
			<?php for($year = 2009; $year < 2013; $year++) { ?>
			<div class="buttons">
			  <a href="list-peserta.php?id=<?php echo $year ?>">
			  <img src="img/icons/date.png" alt=""/><?php echo $year ?></a>
			</div>
			<?php } ?>
			<div class="fix"></div>
			  <?php if($row_list > 0) { ?>
              <table width="100%">
                <thead>
                  <tr>
                    <th width="15">Bil.</th>
					<th>Kod</th>
				    <th>Tajuk Kursus</th>
					<th>Jenis</th>
                    <th class="t-center">Jumlah Berdaftar</th>
                    <th class="t-center">Maksimum</th>
					<th class="t-center">Peratus</th>
                  </tr>
                </thead>
                <tbody>
                  <?php do { ?>
                  <?php 
						$a = $row_list['peserta'];
						$b = $row_list['ts_kursus_bil_max'];
						$total+= $a;
						$max+= $b;
						$percentage=($a/$b)*100;
						$avg=($total/$max)*100;
					?>
                  <tr>
                    <td width="15" class="t-center"><?php echo ++$orderNum; ?></td>
					<td nowrap="nowrap" class="t-center"><?php echo $row_list['ts_kursus_kod']; ?></td>
				    <td><a href="list-peserta-kursus.php?ts_kursus_id=<?php echo $row_list['kursus_id']; ?>#peserta"><?php echo strtoupper($row_list['ts_kursus_nama']); ?></a></td>
					<td nowrap="nowrap" class="t-center"><?php echo $row_list['ts_kursus_vendor']; ?></td>
                    <td nowrap="nowrap" class="t-center"><?php echo $row_list['peserta']; ?></td>
                    <td nowrap="nowrap" class="t-center"><?php echo $row_list['ts_kursus_bil_max']; ?></td>
					<td nowrap="nowrap" class="t-center"><?php echo number_format($percentage); ?>%</td>
                  </tr><?php } while ($row_list = mysql_fetch_assoc($list)); ?>
				  <tfoot>
                  <tr>
                    <td colspan="4" class="t-center">Jumlah</td>
                    <td nowrap="nowrap" class="t-center"><?php echo $total; ?></td>
                    <td nowrap="nowrap" class="t-center"><?php echo $max; ?></td>
					<td nowrap="nowrap" class="t-center">&nbsp;</td>
                  </tr>
				  </tfoot>
                </tbody>
              </table>
			  <?php } else { ?>
				<p class="msg error">Tiada kursus pada tahun ini.</p>
			<?php } ?>
              <div class="fix"></div>
              <div class="buttons">
              <a href="javascript:history.go(-1)">
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
mysql_free_result($list);
?>
