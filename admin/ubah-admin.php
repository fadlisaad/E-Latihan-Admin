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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "ubah_admin")) {
  $updateSQL = sprintf("UPDATE ts_admin SET ts_admin_nama=%s, ts_admin_phone=%s, ts_admin_email=%s, ts_admin_gambar=%s, ts_admin_year=%s WHERE ts_admin_username=%s",
                       GetSQLValueString($_POST['fullname'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['file'], "text"),
                       GetSQLValueString($_POST['admin_year'], "int"),
                       GetSQLValueString($_POST['username'], "text"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($updateSQL, $ts_kursus) or die(mysql_error());

  $updateGoTo = "list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_ubah_admin = "-1";
if (isset($_GET['ts_admin_ID'])) {
  $colname_ubah_admin = $_GET['ts_admin_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_ubah_admin = sprintf("SELECT * FROM ts_admin WHERE ts_admin_ID = %s", GetSQLValueString($colname_ubah_admin, "int"));
$ubah_admin = mysql_query($query_ubah_admin, $ts_kursus) or die(mysql_error());
$row_ubah_admin = mysql_fetch_assoc($ubah_admin);
$totalRows_ubah_admin = mysql_num_rows($ubah_admin);
?>
<?php require_once('../login/auth.php'); ?>
<?php
isset($startRow_list)? $orderNum=$startRow_list:$orderNum=0;
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
<title>Ubah Biodata Admin</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/JavaScript">
<!--
function tmt_confirm(msg){
	document.MM_returnValue=(confirm(unescape(msg)));
}
//-->
</script><!-- InstanceEndEditable --><!-- InstanceParam name="sidebar" type="boolean" value="true" --><!-- InstanceParam name="footer" type="boolean" value="true" --><!-- InstanceParam name="header" type="boolean" value="true" -->
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
        <h3>Ubah Biodata Penyelaras</h3>
        <form action="<?php echo $editFormAction; ?>" name="ubah_admin" method="POST" enctype="multipart/form-data" id="form">
                <fieldset>
                  <legend>Isikan ruangan di bawah dengan maklumat berikut:</legend>
                  
                  <table width="100%" class="nostyle">
                    <tr>
                      <td width="200">Nama</td>
                      <td><input name="fullname" type="text" class="input-text" id="fullname" tabindex="1" value="<?php echo $row_ubah_admin['ts_admin_nama']; ?>" size="50" /></td>
                    </tr>
                    <tr>
                      <td width="200">Username</td>
                      <td><input name="username" type="text" class="input-text" id="username" tabindex="2" value="<?php echo $row_ubah_admin['ts_admin_username']; ?>" /></td>
                    </tr>

                    <tr>
                      <td width="200">E-mail</td>
                      <td><input name="email" type="text" class="input-text" id="email" tabindex="4" value="<?php echo $row_ubah_admin['ts_admin_email']; ?>" /></td>
                    </tr>
                    <tr>
                      <td width="200">Telefon</td>
                      <td><input name="phone" type="text" class="input-text" id="phone" tabindex="5" value="<?php echo $row_ubah_admin['ts_admin_phone']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>Gambar (jika ada)</td>
                      <td><input name="file" type="file" id="file" tabindex="7" value="<?php echo $row_ubah_admin['ts_admin_gambar']; ?>"/>
                        <?php
					$errormsg = "Maaf,gambar gagal dimuat-naik";
					$uploadmsg = "Gambar berjaya dimuat-naik";
					
					if(isset($_FILES['file']['tmp_name'])){
						$target_path = "upload/";
						$target_path = $target_path . basename( $_FILES['file']['name']); 
						if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
						echo "<em>".basename( $_FILES['file']['name'])."</em> ".$uploadmsg;
						} else{
						echo "<em>".basename( $_FILES['file']['name'])."</em> ".$errormsg;
						}
					}else{
					}
					?>
                     <input type="hidden" name="MAX_FILE_SIZE" value="1600000" /></td>
                    </tr>
                  </table>
                  <input name="submit" type="submit" id="button1" value="Hantar"  tabindex="8"/>
                  <input name="reset" type="reset" id="button2" value="Batal"  tabindex="9"/>
                </fieldset>
                    
                <input name="admin_year" type="hidden" id="admin_year" value="2009" />
                <input type="hidden" name="MM_update" value="ubah_admin" />
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
mysql_free_result($ubah_admin);
?>