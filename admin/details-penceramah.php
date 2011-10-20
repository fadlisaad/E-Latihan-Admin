<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Details for topic speaker.
 */
	error_reporting(0);

?><?php require_once('../login/auth.php'); ?>
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

$colname_list_penceramah = "-1";
if (isset($_GET['instruct_id'])) {
  $colname_list_penceramah = $_GET['instruct_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_list_penceramah = sprintf("SELECT DISTINCT ts_topic.topic_id, ts_instructor.*, SUM(ts_topic.topic_rate*ts_topic.topic_hour) AS jumlah, ts_topic.topic_title, ts_topic.topic_rate, ts_topic.topic_status, ts_kursus.ts_kursus_kod FROM ts_instructor, ts_topic, ts_kursus WHERE ts_instructor.instruct_id = %s AND ts_topic.topic_instructor = ts_instructor.instruct_name AND ts_topic.topic_status = ts_kursus.ts_kursus_id GROUP BY ts_topic.topic_title", GetSQLValueString($colname_list_penceramah, "int"));
$list_penceramah = mysql_query($query_list_penceramah, $ts_kursus) or die(mysql_error());
$row_list_penceramah = mysql_fetch_assoc($list_penceramah);
$totalRows_list_penceramah = mysql_num_rows($list_penceramah);
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
<title>Keterangan Penceramah</title>
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
            <h3>Maklumat Penceramah</h3>
            
          <div class="tabs box">
            <ul>
              <li><a href="#tab01"><span>Biodata</span></a></li>
              <li><a href="#tab02"><span>Ceramah</span></a></li>
            </ul>
          </div>
          <div id="tab01">
          <fieldset>
            <legend>Maklumat Peribadi</legend>
            <table width="100%" class="nostyle">
              <tr>
                <td width="20%">Nama</td>
                <td><?php echo strtoupper($row_list_penceramah['instruct_name']); ?></td>
              </tr>
              <tr>
                <td width="20%">IC</td>
                <td><?php echo $row_list_penceramah['instruct_ic']; ?></td>
              </tr>
              <tr>
                <td width="20%">Telefon</td>
                <td><?php echo $row_list_penceramah['instruct_contact']; ?></td>
              </tr>
              <tr>
                <td width="20%">E-mail</td>
                <td><?php echo $row_list_penceramah['instruct_email']; ?></td>
              </tr>
              <tr>
                <td width="20%">Bank</td>
                <td><?php echo $row_list_penceramah['instruct_account_bank']; ?></td>
              </tr>
              <tr>
                <td width="20%">No Akaun</td>
                <td><?php echo $row_list_penceramah['instruct_account_no']; ?></td>
              </tr>
            </table>
          </fieldset>                   
          <fieldset>
            <legend>Maklumat Agensi</legend>
            <table width="100%" class="nostyle">
              <tr>
                <td width="20%">Nama Agensi</td>
                <td><?php echo $row_list_penceramah['instruct_agency']; ?></td>
              </tr>
              <tr>
                <td width="20%">Alamat</td>
                <td><?php echo strtoupper($row_list_penceramah['instruct_agency_address']); ?></td>
              </tr>
              <tr>
                <td width="20%">Jawatan</td>
                <td><?php echo strtoupper($row_list_penceramah['instruct_position']); ?></td>
              </tr>
              <tr>
                <td width="20%">Gred</td>
                <td><?php echo strtoupper($row_list_penceramah['instruct_grade']); ?></td>
              </tr>
              <tr>
                <td width="20%">Taraf</td>
                <td><?php echo strtoupper($row_list_penceramah['instruct_grade_status']); ?></td>
              </tr>
              <tr>
                <td width="20%">Gaji</td>
                <td>RM <?php echo strtoupper($row_list_penceramah['instruct_salary']); ?></td>
              </tr>
            </table>
          </fieldset>
          </div>
          <div id="tab02">
          <table width="100%">
            <thead>
              <tr>
                <th width="15">Bil.</th>
				<th width="40">Kod</th>
			    <th>Ceramah</th>
                <th width="100" class="t-center">Jumlah Bayaran</th>
              </tr>
            </thead>
            <tbody>
              <?php do { ?>
                <tr>
                  <td width="15" class="t-center"><?php echo ++$orderNum; ?></td>
				  <td><a href="list-peserta-kursus.php?ts_kursus_id=<?php echo $row_list_penceramah['topic_status']; ?>"><?php echo $row_list_penceramah['ts_kursus_kod']; ?></a></td>
                  <td><?php echo strtoupper($row_list_penceramah['topic_title']); ?></td>
                  <td width="100" nowrap="nowrap" class="t-right">RM <?php echo $row_list_penceramah['jumlah']; ?></td>
              </tr>
                <?php } while ($row_list_penceramah = mysql_fetch_assoc($list_penceramah)); ?>
            </tbody>
            </table>
          </div>
		  <div class="fix"></div>
			<div class="buttons">
				<a href="../admin/ubah-penceramah.php?id=<?php echo $_GET['instruct_id']; ?>">
				<img src="../ico_edit.gif" alt=""/>Ubah Biodata</a>
			</div>
            <div class="buttons">
				<a href="javascript:history.go(-1)">
				<img src="img/icons/arrow_undo.png" alt=""/>Kembali</a>
			</div>
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
mysql_free_result($list_penceramah);
?>