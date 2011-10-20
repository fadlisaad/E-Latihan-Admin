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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_instructor")) {
  $insertSQL = sprintf("INSERT INTO ts_instructor (instruct_status, instruct_name, instruct_ic, instruct_position, instruct_agency, instruct_agency_address, instruct_grade, instruct_grade_status, instruct_salary, instruct_account_no, instruct_account_bank, instruct_contact, instruct_email, instruct_regdate) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ts_kursus_id'], "int"),
                       GetSQLValueString($_POST['instruct_name'], "text"),
                       GetSQLValueString($_POST['instruct_ic'], "text"),
                       GetSQLValueString($_POST['instruct_position'], "text"),
                       GetSQLValueString($_POST['instruct_agency'], "text"),
                       GetSQLValueString($_POST['instruct_agency_address'], "text"),
                       GetSQLValueString($_POST['instruct_grade'], "text"),
                       GetSQLValueString($_POST['instruct_grade_status'], "text"),
                       GetSQLValueString($_POST['instruct_salary'], "int"),
                       GetSQLValueString($_POST['instruct_account_no'], "text"),
                       GetSQLValueString($_POST['instruct_account_bank'], "text"),
                       GetSQLValueString($_POST['instruct_contact'], "text"),
                       GetSQLValueString($_POST['instruct_email'], "text"),
                       GetSQLValueString($_POST['instruct_regdate'], "text"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "list-penceramah-kursus.php?ts_kursus_id=" . $row_instrct_add['ts_kursus_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_get_kursus = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_get_kursus = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_get_kursus = sprintf("SELECT ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_nama FROM ts_kursus WHERE ts_kursus.ts_kursus_id = %s", GetSQLValueString($colname_get_kursus, "int"));
$get_kursus = mysql_query($query_get_kursus, $ts_kursus) or die(mysql_error());
$row_get_kursus = mysql_fetch_assoc($get_kursus);
$totalRows_get_kursus = mysql_num_rows($get_kursus);
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
<title>MardiLMS - Tambah Penceramah</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "simple"
	});
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

              <h3>Tambah Penceramah bagi kursus <?php echo $row_get_kursus['ts_kursus_nama']; ?></h3>
              <form action="<?php echo $editFormAction; ?>" method="POST" name="add_instructor" id="form">
                <fieldset>
                  <legend>Biodata Peribadi</legend>

                  <table width="100%" class="nostyle">
                    <tr>
                      <td width="15%">Nama Penuh</td>
                      <td><input name="instruct_name" type="text" class="input-text" id="instruct_name" tabindex="1" size="40" />
                        <input name="ts_kursus_id" type="hidden" id="ts_kursus_id" value="<?php echo $row_get_kursus['ts_kursus_id']; ?>" /></td>
                    </tr>
                    <tr>
                      <td width="15%">No IC/Passport</td>
                      <td><input name="instruct_ic" type="text" class="input-text" id="instruct_ic" tabindex="2" /></td>
                    </tr>
                    <tr>
                      <td width="15%">E-mail</td>
                      <td><input name="instruct_email" type="text" class="input-text" id="instruct_email" tabindex="3" /></td>
                    </tr>
                    <tr>
                      <td width="15%">No Telefon</td>
                      <td><input name="instruct_contact" type="text" class="input-text" id="instruct_contact" tabindex="4" /></td>
                    </tr>
                    <tr>
                      <td width="15%">Gred Jawatan</td>
                      <td><input name="instruct_grade" type="text" class="input-text" id="lectAgensi" tabindex="5" /></td>
                    </tr>
                  </table>
                </fieldset>
                
                <fieldset>
                  <legend>Agensi</legend>
                  <table width="100%" class="nostyle">
                    <tr>
                      <td width="15%">Nama Agensi</td>
                      <td><input name="instruct_agency" type="text" class="input-text" id="instruct_agency" tabindex="6" size="40" /></td>
                    </tr>
                    <tr>
                      <td width="15%">Alamat Agensi</td>
                      <td><textarea name="instruct_agency_address" cols="40" rows="5" id="instruct_agency_address" tabindex="7"></textarea></td>
                    </tr>
                    <tr>
                      <td width="15%">Jawatan</td>
                      <td><input name="instruct_position" type="text" class="input-text" id="instruct_position" tabindex="8" size="25" /></td>
                    </tr>
                    <tr>
                      <td width="15%">Taraf Jawatan</td>
                      <td><select name="instruct_grade_status" class="input-text" id="instruct_grade_status" tabindex="9">
                        <option value="Tetap">Tetap</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="Pencen">Pencen</option>
                        <option value="Tetap Berpencen">Tetap Berpencen</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="15%">Bayaran / jam</td>
                      <td><input name="instruct_salary2" type="text" class="input-text" id="instruct_salary" tabindex="10" size="10" />
dalam Ringgit Malaysia (RM)</td>
                    </tr>
                    <tr>
                      <td width="15%">Maksimum</td>
                      <td><input name="instruct_salary" type="text" class="input-text" id="instruct_total" tabindex="10" size="10" />
dalam Ringgit Malaysia (RM)</td>
                    </tr>
                  </table>
                </fieldset>
                
				  <fieldset>
			      <legend>Akaun Bank</legend>
			      <table width="100%" class="nostyle">
                    <tr>
                      <td width="15%">Nama Bank </td>
                      <td><select name="instruct_account_bank" class="input-text" id="instruct_account_bank" tabindex="11">
                        <option value="Maybank">Maybank</option>
                        <option value="CIMB">CIMB</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="15%">No Akaun</td>
                      <td><input name="instruct_account_no" type="text" class="input-text" id="instruct_account_no" tabindex="12" size="30" />
                        <input name="instruct_year" type="hidden" id="instruct_year" value="2009" />
                        <input type="hidden" name="instruct_regdate" id="instruct_regdate" /></td>
                    </tr>
                  </table>
			    </fieldset>
                <div class="fix"></div>
				<?php include 'includes/button.html'; ?>
                <input type="hidden" name="MM_insert" value="add_instructor" />
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
mysql_free_result($get_kursus);
?>