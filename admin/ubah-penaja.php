<?php require_once('../login/auth.php'); ?>
<?php require_once('../Connections/ts_kursus.php'); ?>
<?php
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "vendor_add")) {
  $updateSQL = sprintf("UPDATE ts_vendor SET kursus_vendor_personel=%s, kursus_vendor_alamat=%s, kursus_vendor_telefon=%s, kursus_vendor_fax=%s, kursus_vendor_email=%s, kursus_vendor_nota=%s WHERE kursus_vendor_nama=%s",
                       GetSQLValueString($_POST['vendor_pengurus'], "text"),
                       GetSQLValueString($_POST['vendor_alamat'], "text"),
                       GetSQLValueString($_POST['vendor_telefon'], "text"),
                       GetSQLValueString($_POST['vendor_fax'], "text"),
                       GetSQLValueString($_POST['vendor_email'], "text"),
                       GetSQLValueString($_POST['vendor_nota'], "text"),
                       GetSQLValueString($_POST['vendor_nama'], "text"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($updateSQL, $ts_kursus) or die(mysql_error());

  $updateGoTo = "list-penaja.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "vendor_add")) {
  $updateSQL = sprintf("UPDATE ts_vendor SET kursus_vendor_nama=%s, kursus_vendor_personel=%s, kursus_vendor_alamat=%s, kursus_vendor_telefon=%s, kursus_vendor_fax=%s, kursus_vendor_email=%s, kursus_vendor_nota=%s WHERE kursus_vendor_ID=%s",
                       GetSQLValueString($_POST['vendor_nama'], "text"),
                       GetSQLValueString($_POST['vendor_pengurus'], "text"),
                       GetSQLValueString($_POST['vendor_alamat'], "text"),
                       GetSQLValueString($_POST['vendor_telefon'], "text"),
                       GetSQLValueString($_POST['vendor_fax'], "text"),
                       GetSQLValueString($_POST['vendor_email'], "text"),
                       GetSQLValueString($_POST['vendor_nota'], "text"),
                       GetSQLValueString($_POST['key'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($updateSQL, $ts_kursus) or die(mysql_error());

  $updateGoTo = "http://localhost/vauxite/index.php?option=com_wrapper&view=wrapper&Itemid=302";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $updateGoTo));
}

$colname_vendor_tambah = "-1";
if (isset($_GET['kursus_vendor_ID'])) {
  $colname_vendor_tambah = $_GET['kursus_vendor_ID'];
}
$colname_vendor_tambah = "-1";
if (isset($_GET['kursus_vendor_ID'])) {
  $colname_vendor_tambah = (get_magic_quotes_gpc()) ? $_GET['kursus_vendor_ID'] : addslashes($_GET['kursus_vendor_ID']);
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_vendor_tambah = sprintf("SELECT * FROM ts_vendor WHERE kursus_vendor_ID = %s", $colname_vendor_tambah);
$vendor_tambah = mysql_query($query_vendor_tambah, $ts_kursus) or die(mysql_error());
$row_vendor_tambah = mysql_fetch_assoc($vendor_tambah);
$totalRows_vendor_tambah = mysql_num_rows($vendor_tambah);
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
<title>Ubah Penaja</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/JavaScript">
<!--
function MM_popupMsg(msg) { //v1.0
  alert(msg);
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
              <h3>Ubah Maklumat Penaja</h3>
                <input name="key" type="hidden" id="key" value="<?php echo $row_vendor_tambah['kursus_vendor_ID']; ?>" />
              <form action="<?php echo $editFormAction; ?>" method="POST" name="vendor_add" id="vendor_add">
                <table width="100%" class="nostyle">
                  <tr>
                    <td><strong>Nama Penaja</strong><br />	</td>
	    <td><input name="vendor_nama" type="text" class="input-text" id="vendor_nama" value="<?php echo $row_vendor_tambah['kursus_vendor_nama']; ?>" size="50" />		  </td>
	  </tr>
                  <tr>
                    <td><strong>Pengurus</strong></td>
	    <td><input name="vendor_pengurus" type="text" class="input-text" id="vendor_pengurus" value="<?php echo $row_vendor_tambah['kursus_vendor_personel']; ?>" /></td>
	  </tr>
                  <tr>
                    <td><strong>Telefon</strong></td>
	    <td><input name="vendor_telefon" type="text" class="input-text" id="vendor_telefon" value="<?php echo $row_vendor_tambah['kursus_vendor_telefon']; ?>" size="20" maxlength="12" /></td>
	    </tr>
                  <tr>
                    <td><strong>Fax</strong></td>
	    <td><input name="vendor_fax" type="text" class="input-text" id="vendor_fax" value="<?php echo $row_vendor_tambah['kursus_vendor_fax']; ?>" size="20" maxlength="12" /></td>
	    </tr>
                  <tr>
                    <td class="va-top"><strong class="va-top">Alamat</strong></td>
	    <td><textarea name="vendor_alamat" cols="50" rows="5" class="input-text" id="vendor_alamat"><?php echo $row_vendor_tambah['kursus_vendor_alamat']; ?></textarea></td>
	  </tr>
                  <tr>
                    <td><strong>E-mail </strong></td>
	    <td valign="top"><input name="vendor_email" type="text" class="input-text" id="vendor_email" value="<?php echo $row_vendor_tambah['kursus_vendor_email']; ?>" /></td>
	  </tr>
                  <tr>
                    <td class="va-top"><strong>Nota</strong> (jika ada)</td>
	    <td><textarea name="vendor_nota" cols="50" rows="5" class="input-text" id="vendor_nota"><?php echo $row_vendor_tambah['kursus_vendor_nota']; ?></textarea></td>
	  </tr>
                </table>
    <input type="hidden" name="MM_update" value="vendor_add" />
                <input name="button" type="submit" class="button" id="button" value="Ubah" />
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
mysql_free_result($vendor_tambah);
?>