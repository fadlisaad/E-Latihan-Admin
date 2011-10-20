<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Tambah Topik.
 */
error_reporting(0);
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add_instructor")) {
  $insertSQL = sprintf("INSERT INTO ts_topic (topic_instructor, topic_title, topic_desc, topic_date, topic_date_start, topic_date_end, topic_hour, topic_rate, topic_file, topic_status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['topic_instructor'], "text"),
                       GetSQLValueString($_POST['topic_title'], "text"),
                       GetSQLValueString($_POST['topic_desc'], "text"),
					   GetSQLValueString($_POST['topic_date'], "text"),
                       GetSQLValueString($_POST['topic_start'], "text"),
                       GetSQLValueString($_POST['topic_end'], "text"),
                       GetSQLValueString($_POST['topic_hour'], "int"),
                       GetSQLValueString($_POST['instruct_rate'], "int"),
                       GetSQLValueString($_POST['topic_file'], "text"),
                       GetSQLValueString($_POST['ts_kursus_id'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "list-peserta-kursus.php?ts_kursus_id=" . $row_get_kursus['ts_kursus_id'] . "";
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
$query_get_kursus = sprintf("SELECT ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_nama,ts_instructor.instruct_name, ts_instructor.instruct_status FROM ts_kursus, ts_instructor WHERE ts_kursus.ts_kursus_id=%s", GetSQLValueString($colname_get_kursus, "int"));
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
<title>MardiLMS - Tambah Topik Ceramah</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="includes/timepicker.js"></script>
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

              <h3>Tambah Ceramah bagi kursus <?php echo $row_get_kursus['ts_kursus_nama']; ?></h3>
              <form action="<?php echo $editFormAction; ?>" method="POST" name="add_instructor" id="form">
                <fieldset id="address">
                  <legend>Ceramah</legend>
                  <table width="100%" class="nostyle">
                  	<tr><td width="20%"><strong>Tajuk Ceramah</strong></td>
                  	  <td><input name="topic_title" type="text" class="input-text" id="topic_title" tabindex="1" size="40" />
               	      <input name="ts_kursus_id" type="hidden" id="ts_kursus_id" 
                    value="<?php echo $row_get_kursus['ts_kursus_id']; ?>" /></td>
                  	</tr>
                    <tr><td width="20%" class="va-top"><strong>Keterangan / Sinopsis</strong></td>
                      <td><textarea name="topic_desc" cols="40" rows="5" class="input-text" id="topic_desc" tabindex="2"></textarea></td>
                    </tr>
                    <tr>
                      <td><strong>Lampiran (jika ada)</strong></td>
                      <td><input name="topic_file" type="file" class="input-text" id="topic_file" tabindex="3"/>
                        <?php include 'includes/upload_topic.php'; ?>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1600000" /></td>
                    </tr>
					<tr>
						<td width="15%"><strong>Tarikh Mula</strong></td>
						<td><input name="topic_date" type="text" class="input-text" id="topic_date" size="15" />
							<script type="text/javascript">
							  // <![CDATA[       
								var opts = { formElements:{"topic_date":"Y-ds-m-ds-d"} };        
								datePickerController.createDatePicker(opts);
							  // ]]>
							</script></td>
					</tr>
                    <tr>
                      <td><strong>Masa Mula</strong></td>
                      <td><input name="topic_start" type="text" class="input-text" id="topic_start" tabindex="4" size="10" /></td>
                    </tr>
                    <tr>
                      <td><strong>Masa Tamat</strong></td>
                      <td><input name="topic_end" type="text" class="input-text" id="topic_end" tabindex="5" size="10" /></td>
                    </tr>
                    <tr>
                      <td><strong>Tempoh (Jam)</strong></td>
                      <td><select name="topic_hour" class="input-text" id="topic_hour" tabindex="6">
                        <option value="0.5">0.5 jam</option>
                        <option value="1">1 jam</option>
                        <option value="1.5">1.5 jam</option>
                        <option value="2">2 jam</option>
                        <option value="2.5">2.5 jam</option>
                        <option value="3">3 jam</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td><strong>Penceramah</strong></td>
                      <td><select name="topic_instructor" class="input-text" id="topic_instructor" tabindex="7">
                        <?php
                    do {  
                    ?>
                        <option value="<?php echo $row_get_kursus['instruct_name']?>"<?php if (!(strcmp($row_get_kursus['instruct_name'], $row_get_kursus['instruct_name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_get_kursus['instruct_name']?></option>
                        <?php
                    } while ($row_get_kursus = mysql_fetch_assoc($get_kursus));
                      $rows = mysql_num_rows($get_kursus);
                      if($rows > 0) {
                          mysql_data_seek($get_kursus, 0);
                          $row_get_kursus = mysql_fetch_assoc($get_kursus);
                      }
                    ?>
                      </select>
                        <input name="instruct_year" type="hidden" id="instruct_year" value="2010" />
                        <input name="topic_regdate" type="hidden" id="topic_regdate" value="<?php echo date("d-M-Y"); ?>" /></td>
                    </tr>
                    <tr>
                      <td><strong>Kadar</strong></td>
                      <td><input name="instruct_rate" type="text" class="input-text" id="instruct_rate" tabindex="8" size="10" /> 
                        RM/jam</td>
                    </tr>
                  </table>

                </fieldset>
                <div align="center">
                  <?php include 'includes/button.html'; ?>
                </div>
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