<?php require_once('../Connections/ts_kursus.php'); ?>
<?php require_once('../login/auth.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "rekod-advance")) {
  $insertSQL = sprintf("INSERT INTO ts_advance (ts_advance_kursus_id, ts_advance_penyelaras_id, ts_advance_tarikh_ambil, ts_advance_tarikh_kembali, ts_advance_jumlah) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kursus'], "int"),
                       GetSQLValueString($_POST['penyelaras'], "int"),
                       GetSQLValueString($_POST['tarikh_mohon'], "date"),
                       GetSQLValueString($_POST['tarikh_kembali'], "date"),
                       GetSQLValueString($_POST['jumlah'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "list-peserta-kursus.php?ts_kursus_id=".$_GET['id']."";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_kursus = "-1";
if (isset($_GET['id'])) {
  $colname_kursus = $_GET['id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus = sprintf("SELECT ts_kursus_nama FROM ts_kursus WHERE ts_kursus_id=%s", GetSQLValueString($colname_kursus, "int"));
$kursus = mysql_query($query_kursus, $ts_kursus) or die(mysql_error());
$row_kursus = mysql_fetch_assoc($kursus);
$totalRows_kursus = mysql_num_rows($kursus);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_penyelaras = "SELECT ts_admin.ts_admin_nama, ts_admin.ts_admin_ID FROM ts_admin";
$penyelaras = mysql_query($query_penyelaras, $ts_kursus) or die(mysql_error());
$row_penyelaras = mysql_fetch_assoc($penyelaras);
$totalRows_penyelaras = mysql_num_rows($penyelaras);

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
<title>Bayaran Pendahuluan</title>
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
		<div id="content" class="box">
			<!-- Headings -->
			<h2>Tambah Bayaran Pendahuluan</h2>
			<p class="msg info">Sila masukkan maklumat berikut</p>
			<form method="POST" action="<?php echo $editFormAction; ?>" name="rekod-advance" id="rekod-advance">
			<fieldset id="personal">
                <legend>Informasi</legend>
					<table width="100%" class="nostyle">
						<tr>
							<td>Kursus</td>
							<td>
								<?php echo $row_kursus['ts_kursus_nama']?>
								<input type="hidden" name="kursus" value="<?php echo $_GET['id']; ?>" />
							</td>
						</tr>
						<tr>
							<td width="17%">Nama</td>
							<td width="83%"><select name="penyelaras" id="penyelaras" class="input-text">
							<?php do { ?><option value="<?php echo $row_penyelaras['ts_admin_ID']?>"><?php echo $row_penyelaras['ts_admin_nama']?></option>
							<?php } while ($row_penyelaras = mysql_fetch_assoc($penyelaras));
								$rows = mysql_num_rows($penyelaras);
								if($rows > 0) {
									mysql_data_seek($penyelaras, 0);
									$row_penyelaras = mysql_fetch_assoc($penyelaras);
								} 
							?></select>
							</td>
						</tr>
						
						<tr>
							<td>Tarikh Mohon</td>
							<td>
								<input name="tarikh_mohon" type="text" id="tarikh_mohon" size="15" class="input-text">
								<script type="text/javascript">
								// <![CDATA[       
								var opts = { formElements:{"tarikh_mohon":"Y-ds-m-ds-d"} };        
								datePickerController.createDatePicker(opts);
								// ]]>
								</script>
							</td>
						</tr>
						<tr>
							<td>Tarikh Kembali</td>
							<td>
								<input name="tarikh_kembali" type="text" id="tarikh_kembali" size="15" class="input-text" />
								<script type="text/javascript">
								// <![CDATA[       
								var opts = { formElements:{"tarikh_kembali":"Y-ds-m-ds-d"} };        
								datePickerController.createDatePicker(opts);
								// ]]>
								</script>
							</td>
						</tr>
						<tr>
							<td>Jumlah (RM)</td>
							<td><input name="jumlah" type="text" id="jumlah" size="10" class="input-text" /></td>
						</tr>
					</table>
				<div class="buttons">
					<button type="submit" class="positive">
					<img src="img/icons/tick.png" alt=""/>Hantar</button>
				</div>
				<input type="hidden" name="MM_insert" value="rekod-advance" />
			</form>
		<div class="fix"></div>
		  <!-- 3 columns -->
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
mysql_free_result($penyelaras);
mysql_free_result($rekod);
?>