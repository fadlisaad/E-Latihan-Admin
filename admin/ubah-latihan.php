<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Ubah latihan amali.
 */
require_once('../Connections/ts_kursus.php');
require_once('../login/auth.php');

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE ts_latihan SET ts_latihan_nama=%s, ts_latihan_kod=%s, ts_latihan_kategori=%s, ts_latihan_keterangan=%s, ts_latihan_lokasi=%s, ts_latihan_tarikh_mula=%s, ts_latihan_tarikh_tamat=%s, ts_latihan_harga=%s, ts_latihan_vendor=%s, ts_latihan_admin=%s, ts_latihan_bil_min=%s, ts_latihan_bil_max=%s, ts_latihan_year=%s, ts_latihan_publish_status=%s, ts_latihan_pubdate=%s, ts_latihan_jadual=%s WHERE ts_latihan_id=%s",
                       GetSQLValueString($_POST['kursus_nama'], "text"),
                       GetSQLValueString($_POST['kursus_kod'], "text"),
                       GetSQLValueString($_POST['kursus_kategori'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['kursus_lokasi2'], "text"),
                       GetSQLValueString($_POST['tarikh_mula'], "date"),
                       GetSQLValueString($_POST['tarikh_tamat'], "date"),
                       GetSQLValueString($_POST['kursus_harga'], "int"),
                       GetSQLValueString($_POST['penaja'], "text"),
                       GetSQLValueString($_POST['ts_admin'], "int"),
                       GetSQLValueString($_POST['kursus_min'], "int"),
                       GetSQLValueString($_POST['kursus_max'], "int"),
                       GetSQLValueString($_POST['year'], "int"),
                       GetSQLValueString(isset($_POST['published']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['tarikh_papar'], "text"),
                       GetSQLValueString($_POST['tarikh_tutup'], "date"),
                       GetSQLValueString($_POST['kursus_id'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($updateSQL, $ts_kursus) or die(mysql_error());

  $updateGoTo = "list-peserta-latihan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_kursus_ubah = "-1";
if (isset($_GET['ts_latihan_id'])) {
  $colname_kursus_ubah = $_GET['ts_latihan_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_ubah = sprintf("SELECT * FROM ts_latihan WHERE ts_latihan_id = %s", GetSQLValueString($colname_kursus_ubah, "int"));
$kursus_ubah = mysql_query($query_kursus_ubah, $ts_kursus) or die(mysql_error());
$row_kursus_ubah = mysql_fetch_assoc($kursus_ubah);
$totalRows_kursus_ubah = mysql_num_rows($kursus_ubah);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_kategori = "SELECT * FROM ts_kategori";
$kursus_kategori = mysql_query($query_kursus_kategori, $ts_kursus) or die(mysql_error());
$row_kursus_kategori = mysql_fetch_assoc($kursus_kategori);
$totalRows_kursus_kategori = mysql_num_rows($kursus_kategori);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_vendor = "SELECT * FROM ts_vendor ";
$kursus_vendor = mysql_query($query_kursus_vendor, $ts_kursus) or die(mysql_error());
$row_kursus_vendor = mysql_fetch_assoc($kursus_vendor);
$totalRows_kursus_vendor = mysql_num_rows($kursus_vendor);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_lokasi = "SELECT ts_tempat_ID, ts_tempat_nama FROM ts_tempat_kursus";
$kursus_lokasi = mysql_query($query_kursus_lokasi, $ts_kursus) or die(mysql_error());
$row_kursus_lokasi = mysql_fetch_assoc($kursus_lokasi);
$totalRows_kursus_lokasi = mysql_num_rows($kursus_lokasi);
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
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/wysiwyg.css" />
<!-- FAVICON -->
<link href="http://elearn.mardi.gov.my/templates/jakyaniteii/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!-- DATEPICKER -->
<link rel="stylesheet" type="text/css" href="../js/datepicker.css">
<!-- JAVASCRIPTS -->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>
<script type="text/javascript" src="../js/toggle.js"></script>
<script type="text/javascript" src="../js/ui.core.js"></script>
<script type="text/javascript" src="../js/ui.tabs.js"></script>
<script type="text/javascript" src="../js/datepicker.js"></script>

<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ubah Kursus</title>
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
              <h3>Ubah Kursus</h3>
              <form action="<?php echo $editFormAction; ?>" name="form" method="POST" id="form">
			  <fieldset>
                  <legend>Keterangan Kursus </legend>
                  <table width="100%" class="nostyle">
					<tr>
						<td width="15%">Tahun</td>
						<td><input name="year" type="text" class="input-text" id="year" value="<?php echo $row_kursus_ubah['ts_latihan_year']; ?>" size="5" /></td>
					</tr>
                    <tr>
                      <td width="15%">Tajuk kursus</td>
                      <td><input name="kursus_nama" type="text" class="input-text" id="kursus_nama" value="<?php echo $row_kursus_ubah['ts_latihan_nama']; ?>" size="80" /></td>
                    </tr>
                    <tr>
                      <td width="15%">Kod kursus</td>
                      <td><input name="kursus_kod" type="text" class="input-text" id="kursus_kod" value="<?php echo $row_kursus_ubah['ts_latihan_kod']; ?>" size="15" /></td>
                    </tr>
					<tr>
                      <td width="15%">Tahun</td>
                      <td><input name="year" type="text" class="input-text" id="year" value="<?php echo $row_kursus_ubah['ts_latihan_year']; ?>" size="10" /></td>
                    </tr>
                    <tr>
                      <td width="15%">Kluster</td>
                      <td><input <?php if (!(strcmp($row_kursus_ubah['ts_latihan_kategori'],"Teknologi Tanaman "))) {echo "checked=\"checked\"";} ?> type="radio" name="kursus_kategori" id="kursus_kategori" value="Teknologi Tanaman " />
                        Teknologi Tanaman
                          <br />
                      <input <?php if (!(strcmp($row_kursus_ubah['ts_latihan_kategori'],"Teknologi Ternakan"))) {echo "checked=\"checked\"";} ?> type="radio" name="kursus_kategori" id="kursus_kategori" value="Teknologi Ternakan" />
                        Teknologi Ternakan
                        <br />
                      <input <?php if (!(strcmp($row_kursus_ubah['ts_latihan_kategori'],"Teknologi Makanan"))) {echo "checked=\"checked\"";} ?> type="radio" name="kursus_kategori" id="kursus_kategori" value="Teknologi Makanan" />
                        Teknologi Makanan
                        <br />
                        <input <?php if (!(strcmp($row_kursus_ubah['ts_latihan_kategori'],"Teknologi Lanjutan"))) {echo "checked=\"checked\"";} ?> type="radio" name="kursus_kategori" id="kursus_kategori" value="Teknologi Lanjutan" />
                      Teknologi Lanjutan </td>
                    </tr>
                    <tr>
                      <td width="15%">Jenis Kursus</td>
                      <td><input <?php if (!(strcmp($row_kursus_ubah['ts_latihan_vendor'],"Kursus Berjadual"))) {echo "checked=\"checked\"";} ?> type="radio" name="penaja" id="penaja" value="Kursus Berjadual" />
                        Kursus Berjadual
                          <br />
                        <input <?php if (!(strcmp($row_kursus_ubah['ts_latihan_vendor'],"Kursus Luar Jadual"))) {echo "checked=\"checked\"";} ?> type="radio" name="penaja" id="penaja" value="Kursus Luar Jadual" />
                      Kursus Luar Jadual</td>
                    </tr>
                    <tr>
                      <td width="15%">Lokasi</td>
                      <td><select name="kursus_lokasi2" class="input-text" id="kursus_lokasi2">
					  <?php if ($row_kursus_ubah['ts_latihan_lokasi'] == 'tiada') { ?>
					  <option value="tiada" selected="selected">- Sila Pilih -</option>
					  <?php } else { ?>
					  <option value="<?php echo $row_kursus_ubah['ts_latihan_lokasi']; ?>" selected="selected"><?php echo strtoupper($row_kursus_ubah['ts_latihan_lokasi']); ?></option>
					  <?php } do { ?>
                      <option value="<?php echo strtoupper($row_kursus_lokasi['ts_tempat_nama']); ?>"<?php if (!strcmp($row_kursus_ubah['ts_tempat_nama'], trim(strtoupper($row_kursus_lokasi['ts_tempat_nama'])))) { echo "selected=\"selected\""; } ?>><?php echo strtoupper($row_kursus_lokasi['ts_tempat_nama']); ?></option>
                      <?php } while ($row_kursus_lokasi = mysql_fetch_assoc($kursus_lokasi)); ?>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="15%">Yuran (RM)</td>
                      <td><input name="kursus_harga" type="text" class="input-text" id="kursus_harga" value="<?php echo $row_kursus_ubah['ts_latihan_harga']; ?>" /></td>
                    </tr>
                  </table>
                </fieldset>
			    <fieldset>
		        <legend>Tarikh</legend>
			    <table width="100%" class="nostyle">
                  <tr>
                    <td width="15%">Tarikh Mula</td>
                    <td><input name="tarikh_mula" type="text" class="input-text" id="tarikh_mula" size="15" value="<?php echo $row_kursus_ubah['ts_latihan_tarikh_mula']; ?>"/>
				    <script type="text/javascript">
					  // <![CDATA[       
						var opts = { formElements:{"tarikh_mula":"Y-ds-m-ds-d"} };        
						datePickerController.createDatePicker(opts);
					  // ]]>
					  </script></td>
                  </tr>
                  <tr>
                    <td width="15%">Tarikh Tamat</td>
                    <td><input name="tarikh_tamat" type="text" class="input-text" id="tarikh_tamat" size="15" value="<?php echo $row_kursus_ubah['ts_latihan_tarikh_tamat']; ?>"/>
				    <script type="text/javascript">
					  // <![CDATA[       
						var opts = { formElements:{"tarikh_tamat":"Y-ds-m-ds-d"} };        
						datePickerController.createDatePicker(opts);
					  // ]]>
					  </script></td>
                  </tr>
                  <tr>
                    <td width="15%">Tarikh tutup permohonan</td>
                    <td><input name="tarikh_tutup" type="text" class="input-text" id="tarikh_tutup" size="15" value="<?php echo $row_kursus_ubah['ts_latihan_jadual']; ?>"/>
				    <script type="text/javascript">
					  // <![CDATA[       
						var opts = { formElements:{"tarikh_tutup":"Y-ds-m-ds-d"} };        
						datePickerController.createDatePicker(opts);
					  // ]]>
					  </script></td>
                  </tr>
                  <tr>
                    <td width="15%">Tarikh paparan</td>
                    <td><input name="tarikh_papar" type="text" class="input-text" id="tarikh_papar" size="15" value="<?php echo $row_kursus_ubah['ts_latihan_pubdate']; ?>"/>
				    <script type="text/javascript">
					  // <![CDATA[       
						var opts = { formElements:{"tarikh_papar":"Y-ds-m-ds-d"} };        
						datePickerController.createDatePicker(opts);
					  // ]]>
					  </script></td>
                  </tr>
                </table>
			    </fieldset>
				  
				<fieldset>
			    <legend>Kehadiran</legend>
			    <table width="100%" class="nostyle">
                  <tr>
                    <td width="15%">Maksimum</td>
                    <td><input name="kursus_max" type="text" class="input-text" id="kursus_max" value="<?php echo $row_kursus_ubah['ts_latihan_bil_max']; ?>" size="5" />
orang</td>
                  </tr>
                  <tr>
                    <td width="15%">Minimum</td>
                    <td><input name="kursus_min" type="text" class="input-text" id="kursus_min" value="<?php echo $row_kursus_ubah['ts_latihan_bil_min']; ?>" size="5" />
orang</td>
                  </tr>
                </table>
			    </fieldset>
				  
				<fieldset>
			    <legend>Lain-lain</legend>
			    <table width="100%" class="nostyle">
                  <tr>
                    <td width="15%">Keterangan</td>
                    <td><textarea name="keterangan" cols="30" rows="7" id="keterangan" class="wysiwyg"><?php echo $row_kursus_ubah['ts_latihan_keterangan']; ?></textarea> <p class="msg error">Nota: Jangan 'Copy and paste' dari Microsoft Word. Sila copy ke 'Notepad' dan kemudian 'paste' disini. Ubah keterangan dengan menggunakan format (bold, bullet, numbering) yang disediakan</p></td>
                  </tr>
                  <tr>
                    <td>Papar?</td>
                    <td><input <?php if (!(strcmp($row_kursus_ubah['ts_latihan_publish_status'],1))) {echo "checked=\"checked\"";} ?> name="published" type="checkbox" id="published" value="1" />
Tinggalkan ruangan ini jika tidak mahu paparan kursus serta merta </td>
                  </tr>
                </table>
			    <input name="ts_admin" type="hidden" id="ts_admin" value="<?php echo $_SESSION['SESS_ADMIN_ID']; ?>" />
			    <input name="ts_admin_ID" type="hidden" id="ts_admin_ID" value="<?php echo $_GET['ts_admin_ID']; ?>" />
			    <input name="kursus_id" type="hidden" id="kursus_id" value="<?php echo $row_kursus_ubah['ts_latihan_id']; ?>" />
			    </fieldset>
				  <div id="pager">
				    <?php include "includes/button.html"; ?>
			      </div>
                
                  <input type="hidden" name="MM_update" value="form" />
              </form>
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
mysql_free_result($kursus_ubah);
mysql_free_result($kursus_kategori);
mysql_free_result($kursus_lokasi);
mysql_free_result($kursus_vendor);
?>
