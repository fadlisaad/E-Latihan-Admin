<?php require_once('../Connections/ts_kursus.php'); ?>
<?php require_once('auth.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add-user")) {
  $insertSQL = sprintf("INSERT INTO ts_invoice (peserta_id, kursus_id, invoices, lastupdate) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['kursus_id'], "int"),
                       GetSQLValueString($_POST['invoice'], "text"),
                       GetSQLValueString($_POST['registerDate'], "date"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "user-daftar-berjaya.php?ts_peserta_ic=".$row_user_login['ts_peserta_ic']."&ts_kursus_id=".$row_user_daftar['ts_kursus_id']."";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_user_login = "-1";
if (isset($_GET['ts_peserta_ic'])) {
  $colname_user_login = $_GET['ts_peserta_ic'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_user_login = sprintf("SELECT * FROM ts_peserta, ts_invoice WHERE ts_peserta_ic = %s AND ts_invoice.peserta_id = ts_peserta.ts_peserta_ID", GetSQLValueString($colname_user_login, "int"));
$user_login = mysql_query($query_user_login, $ts_kursus) or die(mysql_error());
$row_user_login = mysql_fetch_assoc($user_login);
$totalRows_user_login = mysql_num_rows($user_login);

$colname_user_daftar = "-1";
if (isset($_GET['ts_peserta_ic'])) {
  $colname_user_daftar = $_GET['ts_peserta_ic'];
}
$colname2_user_daftar = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname2_user_daftar = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_user_daftar = sprintf("SELECT ts_kursus.*, ts_peserta.ts_peserta_ic, ts_peserta.ts_peserta_ID FROM ts_peserta, ts_kursus WHERE ts_peserta.ts_peserta_ic = %s AND ts_kursus.ts_kursus_id = %s", GetSQLValueString($colname_user_daftar, "text"),GetSQLValueString($colname2_user_daftar, "int"));
$user_daftar = mysql_query($query_user_daftar, $ts_kursus) or die(mysql_error());
$row_user_daftar = mysql_fetch_assoc($user_daftar);
$totalRows_user_daftar = mysql_num_rows($user_daftar);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
<!-- WRITE YOUR CSS CODE HERE -->
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
<script type="text/javascript" src="../admin/script/datepicker.js"></script>
<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "simple"
	});
</script>

<title>Halaman Pengguna</title>
</head>
<body>

<div id="main">
	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="../design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="../design/switcher-2col.gif" alt="2 Columns" /></a></span>

			E-Latihan: <strong>Halaman Pengguna</strong></p>

	  <p class="f-right"><?php echo ucwords($_SESSION['SESS_FULLNAME']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="logout.php" id="logout">Log keluar</a></strong></p>
  </div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	
	<div id="menu" class="box">
	  <ul class="box">
        <li><a href="user.php?ts_peserta_ic=<?php echo $_SESSION['SESS_USERNAME']; ?>&ts_kursus_id=<?php echo $row_user_daftar['ts_kursus_id']; ?>"><span>Halaman Utama</span></a></li>
		<li><a href="user-edit.php?ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><span>Ubah Biodata</span></a></li>
		<li><a href="logout.php"><span>Log Keluar</span></a></li>
        
        <li><a href="kursus_luar_jadual.php?ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><span>Kursus Luar Jadual</span></a></li>
        <li><a href="kursus_senarai.php?ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><span>Kursus Berjadual</span></a></li>
      </ul>
    </div>
	
	<!-- /header -->

<hr class="noscreen" />

	<!-- Columns -->
  <div id="cols" class="box">

		<!-- Aside (Left Column) -->
		
		<div id="aside" class="box">
          <div class="padding box">
            <!-- Logo (Max. width = 200px) -->
            <p id="logo">&nbsp;</p>
            <!-- Search -->
            <!-- Create a new project -->
          </div>
		  <!-- /padding 
          <ul class="box">
			<li id="submenu-active"><a href="#">Menu Utama</a>
                <ul>
                  <li><a href="#">Lorem ipsum</a></li>
                  <li><a href="#">Lorem ipsum</a></li>
                  <li><a href="#">Lorem ipsum</a></li>
                  <li><a href="#">Lorem ipsum</a></li>
                  <li><a href="#">Lorem ipsum</a></li>
                </ul>
            </li>
            </ul> -->
	    </div>
		
		<!-- /aside -->

    <hr class="noscreen" />

	  <!-- Content (Right Column) --> 
 
    <div id="content">
  <fieldset>
  <legend>Keterangan Kursus</legend>
  <h3>Selamat kembali, <?php echo ucwords($_SESSION['SESS_FULLNAME']);?></h3>
  <p class="msg info">Sila pastikan kursus yang anda ingin daftar betul, kemudian klik pada pautan 'Daftar'</p>
  <table width="100%" class="nostyle">
    <tr>
      <td width="150">Tajuk Kursus</td>
      <td><?php echo strtoupper($row_user_daftar['ts_kursus_nama']); ?></td>
    </tr>
    <tr>
      <td width="150">Kod Kursus</td>
      <td><?php echo $row_user_daftar['ts_kursus_kod']; ?></td>
    </tr>
    <tr>
      <td width="150">Kluster Kursus</td>
      <td><?php echo strtoupper($row_user_daftar['ts_kursus_kategori']); ?></td>
    </tr>
    <tr>
      <td width="150">Yuran</td>
      <td>RM <?php echo $row_user_daftar['ts_kursus_harga']; ?></td>
    </tr>
    <tr>
      <td width="150">Tarikh</td>
      <td><?php if ($row_user_daftar['ts_kursus_tarikh_mula']=='0000-00-00'){
					echo 'Akan ditentukan'; 
				}
				else { 
					echo date("d/m/Y",strtotime($row_user_daftar['ts_kursus_tarikh_mula'])); ?>
                - <?php echo date("d/m/Y",strtotime($row_user_daftar['ts_kursus_tarikh_tamat']));
					}
				?></td>
    </tr>
    <tr>
      <td width="150">Tempat</td>
      <td><?php echo strtoupper($row_user_daftar['ts_kursus_lokasi']); ?></td>
    </tr>
    <tr>
      <td width="150">Sinopsis</td>
      <td><?php echo $row_user_daftar['ts_kursus_keterangan']; ?></td>
    </tr>
  </table>
  <form method="POST" name="add-user" action="<?php echo $editFormAction; ?>" id="add-user">
  	<input name="user_id" type="hidden" value="<?php echo $_SESSION['SESS_ADMIN_ID'] ?>" />
    <input name="kursus_id" type="hidden" value="<?php echo $row_user_daftar['ts_kursus_id']; ?>" />
    <input name="invoice" type="hidden" value="E<?php echo date('ymHms'); ?>" />
    <input name="registerDate" type="hidden" value="<?php echo date('Y-m-d') ?>" />
    <input type="hidden" name="MM_insert" value="add-user" />
    <div class="buttons">
    <button type="submit" class="positive">
    <img src="../admin/img/icons/tick.png" alt=""/>Daftar</button>
    </div>
    <div class="buttons">
    <a href="javascript:history.go(-1)">
    <img src="../admin/img/icons/cross.png" alt=""/>Batal</a></div>
  </form>
  </fieldset>
  <!-- /tab closed -->	
    </div>
		<!-- /content -->

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
</html>
<?php
mysql_free_result($user_login);
mysql_free_result($user_daftar);
?>