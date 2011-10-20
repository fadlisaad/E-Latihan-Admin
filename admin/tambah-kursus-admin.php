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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO ts_kursus (ts_kursus_nama, ts_kursus_kod, ts_kursus_kategori, ts_kursus_keterangan, ts_kursus_lokasi, ts_kursus_tarikh_mula, ts_kursus_tarikh_tamat, ts_kursus_harga, ts_kursus_vendor, ts_kursus_admin, ts_kursus_bil_min, ts_kursus_bil_max, ts_kursus_year, ts_kursus_publish_status, ts_kursus_pubdate, ts_kursus_jadual) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kursus_nama'], "text"),
                       GetSQLValueString($_POST['kursus_kod'], "text"),
                       GetSQLValueString($_POST['kursus_kategori'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['kursus_lokasi2'], "text"),
                       GetSQLValueString($_POST['tarikh_mula'], "date"),
                       GetSQLValueString($_POST['tarikh_tamat'], "date"),
                       GetSQLValueString($_POST['kursus_harga'], "int"),
                       GetSQLValueString($_POST['kursus_vendor'], "text"),
                       GetSQLValueString($_POST['admin'], "int"),
                       GetSQLValueString($_POST['kursus_min'], "int"),
                       GetSQLValueString($_POST['kursus_max'], "int"),
                       GetSQLValueString($_POST['year'], "int"),
                       GetSQLValueString(isset($_POST['published']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['tarikh_papar'], "date"),
                       GetSQLValueString($_POST['tarikh_tutup'], "date"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "list-kursus.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_kategori = "SELECT * FROM ts_kategori";
$kursus_kategori = mysql_query($query_kursus_kategori, $ts_kursus) or die(mysql_error());
$row_kursus_kategori = mysql_fetch_assoc($kursus_kategori);
$totalRows_kursus_kategori = mysql_num_rows($kursus_kategori);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_vendor = "SELECT kursus_vendor_ID, kursus_vendor_nama FROM ts_vendor";
$kursus_vendor = mysql_query($query_kursus_vendor, $ts_kursus) or die(mysql_error());
$row_kursus_vendor = mysql_fetch_assoc($kursus_vendor);
$totalRows_kursus_vendor = mysql_num_rows($kursus_vendor);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_lokasi = "SELECT ts_tempat_ID, ts_tempat_nama FROM ts_tempat_kursus";
$kursus_lokasi = mysql_query($query_kursus_lokasi, $ts_kursus) or die(mysql_error());
$row_kursus_lokasi = mysql_fetch_assoc($kursus_lokasi);
$totalRows_kursus_lokasi = mysql_num_rows($kursus_lokasi);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_tambah = "SELECT * FROM ts_kursus";
$kursus_tambah = mysql_query($query_kursus_tambah, $ts_kursus) or die(mysql_error());
$row_kursus_tambah = mysql_fetch_assoc($kursus_tambah);
$totalRows_kursus_tambah = mysql_num_rows($kursus_tambah);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_admin = "SELECT ts_admin_ID, ts_admin.ts_admin_nama FROM ts_admin ";
$admin = mysql_query($query_admin, $ts_kursus) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);
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
<title>Tambah Kursus</title>
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

                <h3 id="adduser">Tambah Kursus </h3>
              <form name="form1" action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" id="form">
                <fieldset id="personal">
                  <legend>Keterangan Kursus </legend>
                  <table width="100%" class="nostyle">
                    <tr>
                      <td width="100">Tajuk kursus</td>
                      <td><input name="kursus_nama" type="text" class="input-text" id="kursus_nama" size="50" /></td>
                    </tr>
                    <tr>
                      <td width="100">Kod kursus</td>
                      <td><input name="kursus_kod" type="text" class="input-text" id="kursus_kod" size="15" /></td>
                    </tr>
                    <tr>
                      <td width="100">Kluster</td>
                      <td><select name="kursus_kategori" id="kursus_kategori">
                          <option value="tiada" <?php if (!(strcmp("tiada", $row_kursus_kategori['ts_kategori_nama']))) {
					echo "selected=\"selected\"";} ?>>- Sila Pilih -</option>
                          <?php
						do {  
						?>
                          <option value="<?php echo $row_kursus_kategori['ts_kategori_nama']?>"<?php if (!(strcmp($row_kursus_kategori['ts_kategori_nama'], $row_kursus_kategori['ts_kategori_nama']))) {echo "selected=\"selected\"";} ?>><?php echo $row_kursus_kategori['ts_kategori_nama']?></option>
                          <?php
						} while ($row_kursus_kategori = mysql_fetch_assoc($kursus_kategori));
						  $rows = mysql_num_rows($kursus_kategori);
						  if($rows > 0) {
							  mysql_data_seek($kursus_kategori, 0);
							  $row_kursus_kategori = mysql_fetch_assoc($kursus_kategori);
						  }
						?>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="100">Jenis kursus</td>
                      <td><select name="kursus_vendor" id="kursus_vendor">
                          <option value="tiada" <?php if (!(strcmp("tiada", $row_kursus_vendor['kursus_vendor_nama']))) {
					echo "selected=\"selected\"";} ?> <?php if (!(strcmp("tiada", $row_kursus_vendor['kursus_vendor_nama']))) {echo "selected=\"selected\"";} ?>>- Sila Pilih -</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_kursus_vendor['kursus_vendor_nama']?>"<?php if (!(strcmp($row_kursus_vendor['kursus_vendor_nama'], $row_kursus_vendor['kursus_vendor_nama']))) {echo "selected=\"selected\"";} ?>><?php echo $row_kursus_vendor['kursus_vendor_nama']?></option>
                          <?php
} while ($row_kursus_vendor = mysql_fetch_assoc($kursus_vendor));
  $rows = mysql_num_rows($kursus_vendor);
  if($rows > 0) {
      mysql_data_seek($kursus_vendor, 0);
	  $row_kursus_vendor = mysql_fetch_assoc($kursus_vendor);
  }
?>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="100">Lokasi kursus</td>
                      <td><select name="kursus_lokasi2" id="kursus_lokasi2">
                          <option value="tiada" <?php if (!(strcmp("tiada", $row_kursus_lokasi['ts_tempat_nama']))) {echo "selected=\"selected\"";} ?>>- Sila Pilih -</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_kursus_lokasi['ts_tempat_nama']?>"<?php if (!(strcmp($row_kursus_lokasi['ts_tempat_nama'], $row_kursus_lokasi['ts_tempat_nama']))) {echo "selected=\"selected\"";} ?>><?php echo $row_kursus_lokasi['ts_tempat_nama']?></option>
                          <?php
} while ($row_kursus_lokasi = mysql_fetch_assoc($kursus_lokasi));
  $rows = mysql_num_rows($kursus_lokasi);
  if($rows > 0) {
      mysql_data_seek($kursus_lokasi, 0);
	  $row_kursus_lokasi = mysql_fetch_assoc($kursus_lokasi);
  }
?>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="100">Yuran (RM)</td>
                      <td><input name="kursus_harga" type="text" class="input-text" id="kursus_harga" /></td>
                    </tr>
                  </table>
                </fieldset>
			    <fieldset id="personal">
		        <legend>Tarikh</legend>
			    <table width="100%" class="nostyle">
                  <tr>
                    <td width="100">Tarikh Mula</td>
                    <td><input name="tarikh_mula" type="text" class="input-text" id="tarikh_mula" size="15" />
                      <input type=button value="Pilih Tarikh" onclick="displayDatePicker('tarikh_mula', this);" /></td>
                  </tr>
                  <tr>
                    <td width="100">Tarikh Tamat</td>
                    <td><input name="tarikh_tamat" type="text" class="input-text" id="tarikh_tamat" size="15" />
                      <input type=button value="Pilih Tarikh" onclick="displayDatePicker('tarikh_tamat', this);" /></td>
                  </tr>
                  <tr>
                    <td width="100">Tarikh tutup permohonan</td>
                    <td><input name="tarikh_tutup" type="text" class="input-text" id="tarikh_tutup" size="15" />
                      <input type="button" value="Pilih Tarikh" onclick="displayDatePicker('tarikh_tutup', this);" /></td>
                  </tr>
                  <tr>
                    <td width="100">Tarikh paparan</td>
                    <td><input name="tarikh_papar" type="text" class="input-text" id="tarikh_papar" size="15" />
                      <input type=button value="Pilih Tarikh" onclick="displayDatePicker('tarikh_papar', this);" />
                      <br />
                    Pastikan tarikh paparan sekurang-kurangnya 1 bulan dari tarikh kursus</td>
                  </tr>
                </table>
			    </fieldset>
				<fieldset id="personal">
			    <legend>Kehadiran</legend>
                <table width="100%" class="nostyle">
                  <tr>
                    <td width="100">Maksimum</td>
                    <td><input name="kursus_max" type="text" class="input-text" id="kursus_max" size="5" />
                    peserta</td>
                  </tr>
                  <tr>
                    <td width="100">Minimum</td>
                    <td><input name="kursus_min" type="text" class="input-text" id="kursus_min" size="5" />
                    peserta</td>
                  </tr>
                </table>

			    </fieldset>  
				<fieldset id="personal">
			    <legend>Lain-lain</legend>
                <table width="100%" class="nostyle">
                  <tr>
                    <td width="100" class="va-top">Keterangan / Sinopsis</td>
                    <td><textarea name="keterangan" id="keterangan"></textarea></td>
                  </tr>
                  <tr>
                    <td width="100">Penyelaras</td>
                    <td><select name="admin" class="input-text" id="admin">
                      <option value="tiada" <?php if (!(strcmp("tiada", $row_admin['ts_admin_nama']))) {
					echo "selected=\"selected\"";} ?> <?php if (!(strcmp("tiada", $row_admin['ts_admin_nama']))) {echo "selected=\"selected\"";} ?>>- Sila Pilih -</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_admin['ts_admin_ID']?>"<?php if (!(strcmp($row_admin['ts_admin_ID'], $row_admin['ts_admin_nama']))) {echo "selected=\"selected\"";} ?>><?php echo $row_admin['ts_admin_nama']?></option>
                      <?php
} while ($row_admin = mysql_fetch_assoc($admin));
  $rows = mysql_num_rows($admin);
  if($rows > 0) {
      mysql_data_seek($admin, 0);
	  $row_admin = mysql_fetch_assoc($admin);
  }
?>
                    </select></td>
                  </tr>
                  <tr>
                    <td width="100">Papar?</td>
                    <td><input name="published" type="checkbox" id="published" value="1" checked="checked" />
Tinggalkan ruangan ini jika tidak mahu paparan kursus serta merta </td>
                  </tr>
                </table>
                </fieldset>
  <div id="pager">
    <?php include "includes/button.html"; ?>
    </div>
               <input type="hidden" name="MM_insert" value="form1">
                <input type="hidden" name="MAX_FILE_SIZE" value="1600000" />
                <?php
// Image Uploading ...
$dir = "../files";
$types = array("image/png","image/x-png","image/gif","image/jpeg","image/pjpeg");
$fullpath = "$dir/";

if (!empty($_FILES['lampiran']['name'])) {
	if ($_FILES['lampiran']['size'] == 0) {
		$message  = '<b>Error:</b> Image (0 byte) <p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	} elseif ($_FILES['lampiran']['size'] > 524288) {
		$message  = '<b>Error:</b> Image (Max.: 512 k.byte)<p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	}
	$picture_1_tmp_name = $_FILES['lampiran']['tmp_name']; 
	$picture_1_new_name = $_FILES['lampiran']['name']; 
	$picture_1_clean_name = substr($picture_1_new_name, -4);
	$picture_1_date = randomkeys(10);
	$picture_1 = $picture_1_date . $picture_1_clean_name;
	if (in_array($_FILES['lampiran']['type'], $types)) {
		move_uploaded_file($picture_1_tmp_name, $fullpath . $picture_1);
		$sorgu = mysql_query(sprintf("UPDATE ts_kursus SET ts_kursus_peta = '%s' WHERE ts_kursus_id = '%s';", $picture_1, $event_id));
	} else {
		$message  = '<b>Error:</b> Extension fail for Image!';
		die($message);
	}
}
?>
                <input name="year" type="hidden" id="year" value="<?php echo date('Y') ?>" />
                </form>
                  <div id="box">
                    <input name="ts_admin_ID" type="hidden" id="ts_admin_ID" value="<?php echo $_GET['ts_admin_ID']; ?>" />
                    
                    <label for="kursus_nama"></label>
                    <br />
                    <label></label>
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
mysql_free_result($kursus_kategori);
mysql_free_result($kursus_lokasi);
mysql_free_result($kursus_tambah);
mysql_free_result($admin);
mysql_free_result($kursus_vendor);
?>