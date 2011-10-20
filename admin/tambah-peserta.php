<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Tambah peserta kursus (maklumat baru).
 */
require_once('../Connections/ts_kursus.php');
require_once('../login/auth.php');

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO ts_peserta (ts_peserta_nama, ts_peserta_ic, ts_peserta_handfone, ts_peserta_homeline, ts_peserta_alamat, ts_peserta_email, ts_peserta_umur, ts_peserta_jantina, ts_peserta_perkahwinan, ts_peserta_pendidikan, ts_peserta_pekerjaan, ts_peserta_perusahaan, ts_majikan_nama, ts_majikan_alamat, ts_majikan_telefon, ts_peserta_register_date, ts_peserta_password, ts_peserta_status, ts_peserta_year) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['ic_no'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['home'], "int"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['umur'], "int"),
                       GetSQLValueString($_POST['jantina'], "text"),
                       GetSQLValueString($_POST['status_perkahwinan'], "text"),
                       GetSQLValueString($_POST['pendidikan'], "text"),
                       GetSQLValueString($_POST['pekerjaan'], "text"),
                       GetSQLValueString($_POST['perusahaan'], "text"),
                       GetSQLValueString($_POST['nama_majikan'], "text"),
                       GetSQLValueString($_POST['alamat_majikan'], "text"),
                       GetSQLValueString($_POST['telefon_majikan'], "int"),
                       GetSQLValueString($_POST['registerDate'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['ts_kursus_id'], "int"),
                       GetSQLValueString($_POST['registerDate'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "list-peserta-kursus.php?ts_kursus_id=" . $row_ts_kursus_data['ts_kursus_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_ts_kursus_data = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_ts_kursus_data = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_ts_kursus_data = sprintf("SELECT ts_kursus_id, ts_kursus_nama, ts_peserta.ts_peserta_ID FROM ts_kursus, ts_peserta WHERE ts_kursus_id = %s", GetSQLValueString($colname_ts_kursus_data, "int"));
$ts_kursus_data = mysql_query($query_ts_kursus_data, $ts_kursus) or die(mysql_error());
$row_ts_kursus_data = mysql_fetch_assoc($ts_kursus_data);
$totalRows_ts_kursus_data = mysql_num_rows($ts_kursus_data);
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
<script type="text/javascript" src="script/jquery.maskedinput.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
		$("#ic_no").mask("999999-99-9999");
	});
</script>
<script type="text/javascript" src="../js/datepicker.js"></script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Pendaftaran Peserta</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--

pic1 = new Image(16, 16); 
pic1.src = "check-username/loader.gif";

$(document).ready(function(){

	$("#ic_no").change(function() { // check IC

	var usr = $("#ic_no").val();

	if(usr.length >= 6)
	{
	$("#status-ic").html('<img src="check-username/loader.gif" align="absmiddle">&nbsp;Semakan No IC...');

		$.ajax({  
		type: "POST",  
		url: "check-username/check.php",  
		data: "ic_no="+ usr,  
		success: function(msg){  
	   
	   $("#status-ic").ajaxComplete(function(event, request, settings){ 

		if(msg == 'OK')
		{ 
			$("#ic_no").removeClass('object_error'); // if necessary
			$("#ic_no").addClass("object_ok");
			$(this).html('&nbsp;<img src="check-username/tick.gif" align="absmiddle">');
		}  
		else  
		{  
			$("#ic_no").removeClass('object_ok'); // if necessary
			$("#ic_no").addClass("object_error");
			$(this).html(msg);
		}  
	   
	   });

	 } 
	   
	  }); 

	}
	else
		{
		$("#status-ic").html('<font color="red">No IC mestilah mengandungi <strong>12</strong> atau lebih nombor.</font>');
		$("#ic_no").removeClass('object_ok'); // if necessary
		$("#ic_no").addClass("object_error");
		}

	});
	
	$("#email").change(function() { //check email

	var usr = $("#email").val();

	if(usr.length >= 6)
	{
	$("#status-email").html('<img src="check-username/loader.gif" align="absmiddle">&nbsp;Semakan email...');

		$.ajax({  
		type: "POST",  
		url: "check-username/check.php",  
		data: "email="+ usr,  
		success: function(msg){  
	   
	   $("#status-email").ajaxComplete(function(event, request, settings){ 

		if(msg == 'OK')
		{ 
			$("#email").removeClass('object_error'); // if necessary
			$("#email").addClass("object_ok");
			$(this).html('&nbsp;<img src="check-username/tick.gif" align="absmiddle">');
		}  
		else  
		{  
			$("#email").removeClass('object_ok'); // if necessary
			$("#email").addClass("object_error");
			$(this).html(msg);
		}  
	   
	   });

	 } 
	   
	  }); 

	}
	else
		{
		$("#status-email").html('<font color="red">Email tidak sah atau format salah</font>');
		$("#email").removeClass('object_ok'); // if necessary
		$("#email").addClass("object_error");
		}

	});

});

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
            <h3>Pendaftaran untuk kursus <?php echo $row_ts_kursus_data['ts_kursus_nama']; ?></h3>
            <hr />
            <form name="form" id="form" action="<?php echo $editFormAction; ?>" method="POST">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="nostyle">
					<tr>
						<td width="20%">Nama(seperti dalam kad pengenalan)</td>
						<td width="2%">:</td>
						<td><input name="name" type="text" class="input-text" id="name" tabindex="1" size="40" /></td>
					</tr>
					<tr>
						<td width="20%">No. IC</td>
						<td width="2%">:</td>
						<td><input name="ic_no" type="text" class="input-text" id="ic_no" tabindex="2" autocomplete=off/>&nbsp;<span id="status-ic"></span></td>
					</tr>
					<tr>
						<td width="20%">Password</td>
						<td width="2%">:</td>
						<td><input name="password" type="password" class="input-text" id="password" tabindex="3" value="123456"/>&nbsp;Password sementara adalah 123456</td>
					</tr>
					<tr>
						<td width="20%">E-mail</td>
						<td width="2%">:</td>
						<td><input name="email" type="text" class="input-text" id="email" tabindex="4" /><span id="status-email"></span></td>
					</tr>
					<tr>
						<td width="20%">Telefon bimbit</td>
						<td width="2%">:</td>
						<td><input name="phone" type="text" class="input-text" id="phone" tabindex="5" value="+601" maxlength="12" /></td>
					</tr>
					<tr>
						<td>Telefon pejabat/rumah</td>
						<td>:</td>
						<td><input name="home" type="text" class="input-text" id="home" tabindex="5" value="+60" maxlength="12" /></td>
					</tr>
					<tr>
						<td width="20%" valign="top" class="va-top">Alamat Rumah</td>
						<td width="2%" valign="top" >:</td>
						<td><textarea name="address" cols="45" rows="5" tabindex="6" ></textarea></td>
					</tr>
					<tr>
						<td>Umur</td>
						<td>:</td>
						<td><input name="umur" type="text" class="input-text" id="umur" size="3" maxlength="2" />&nbsp;tahun</td>
					</tr>
					<tr>
						<td>Jantina</td>
						<td>:</td>
						<td>
							<input type="radio" name="jantina" id="lelaki" value="lelaki" />&nbsp;Lelaki 
							<input type="radio" name="jantina" id="perempuan" value="perempuan" />&nbsp;Perempuan
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td>
							<input type="radio" name="status_perkahwinan" id="bujang" value="bujang" />&nbsp;Bujang
							<input type="radio" name="status_perkahwinan" id="berkahwin" value="berkahwin" />&nbsp;Berkahwin 
							<input type="radio" name="status_perkahwinan" id="ibu_tunggal" value="ibu tunngal" />&nbsp;Ibu tunggal
						</td>
					</tr>
					<tr>
						<td>Kelulusan akademik tertinggi</td>
						<td>:</td>
						<td>
							<select name="pendidikan" class="input-text" id="pendidikan">
								<option value="tiada" selected="selected">- sila pilih -</option>
								<option value="pmr">SRP/PMR</option>
								<option value="spm">SPM</option>
								<option value="stpm">STPM</option>
								<option value="diploma">Diploma</option>
								<option value="sarjana muda">Ijazah Sarjana Muda</option>
								<option value="sarjana">Ijazah Sarjana</option>
								<option value="phd">PHD</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Pekerjaan sekarang</td>
						<td>:</td>
						<td>
							<select name="pekerjaan" class="input-text" id="pekerjaan">
								<option value="tiada" selected="selected">- sila pilih -</option>
								<option value="kerajaan">Kakitangan Kerajaan</option>
								<option value="swasta">Swasta</option>
								<option value="kerja sendiri">Bekerja sendiri</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Perniagaan diusahakan sekarang (jika ada)</td>
						<td>:</td>
						<td><input name="perusahaan" type="text" class="input-text" id="perusahaan" /></td>
					</tr>
					<tr>
						<td>Majikan</td>
						<td>:</td>
						<td><input name="nama_majikan" type="text" class="input-text" id="nama_majikan" /></td>
					</tr>
					<tr>
						<td valign="top" class="va-top">Alamat Majikan</td>
						<td valign="top" >:</td>
						<td><textarea name="alamat_majikan" id="alamat_majikan" cols="45" rows="5"></textarea></td>
					</tr>
					<tr>
						<td>Telefon Majikan</td>
						<td>:</td>
						<td><input name="telefon_majikan" type="text" class="input-text" id="telefon_majikan" value="+60" /></td>
					</tr>
                </table>
				<hr />
                <div>
                    <?php include("includes/button.html"); ?>
                </div> 
                <input type="hidden" name="MM_insert" value="form" />
                <input name="registerDate" type="hidden" id="registerDate" value="<?php echo date("d-m-Y"); ?>" />
                <input name="ts_kursus_id" type="hidden" id="ts_kursus_id" value="<?php echo $row_ts_kursus_data['ts_kursus_id']; ?>" />
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
mysql_free_result($ts_kursus_data);
?>
