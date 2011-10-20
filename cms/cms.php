<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Main page for CMS.
 */
	error_reporting(0);
	require_once ('../localization.php');
	
	// I18N support information here
	$language = 'en';
	putenv("LANG=$language"); 
	setlocale(LC_ALL, $language);
	
	// Set the text domain as 'messages'
	$domain = 'mardilms';
	bindtextdomain($domain, "../ts/locale"); 
	textdomain($domain);
?>
<?php require_once('../login/auth.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO ts_cms (cms_title, cms_content, cms_url) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString(isset($_POST['kategori']) ? "true" : "", "defined","'Y'","'N'"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "cms.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_cms = "SELECT * FROM ts_cms WHERE ts_cms.cms_url='Y'";
$cms = mysql_query($query_cms, $ts_kursus) or die(mysql_error());
$row_cms = mysql_fetch_assoc($cms);
$totalRows_cms = mysql_num_rows($cms);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_berita = "SELECT * FROM ts_cms WHERE ts_cms.cms_url='N'";
$berita = mysql_query($query_berita, $ts_kursus) or die(mysql_error());
$row_berita = mysql_fetch_assoc($berita);
$totalRows_berita = mysql_num_rows($berita);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/elatihan/ts/templates/admin_main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>CMS</title>
<!-- InstanceEndEditable -->
<link rel="alternate" href="../rss.php" title="E-Learning RSS" type="application/rss+xml" />  
<link rel="stylesheet" type="text/css" href="../admin/css/theme1.css" />
<link rel="stylesheet" type="text/css" href="../admin/css/style.css" />
<script>
   var StyleFile = "theme" + document.cookie.charAt(6) + ".css";
   document.writeln('<link rel="stylesheet" type="text/css" href="css/' + StyleFile + '">');
</script>
<script type="text/javascript" src="../admin/script/datepicker.js"></script>
<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "simple"
	});
</script>
<script type="text/javascript" src="../js/sorttable/sorttable.js"></script>
<script type="text/javascript" src="../js/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../js/scriptaculous/src/scriptaculous.js"></script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="../tiny_mce/utils/validate.js"></script>
<!-- InstanceEndEditable --><!-- InstanceParam name="head" type="boolean" value="true" --><!-- InstanceParam name="menu" type="boolean" value="true" --><!-- InstanceParam name="menu_right" type="boolean" value="true" --><!-- InstanceParam name="footer" type="boolean" value="true" -->
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:828px;
	top:19px;
	width:143px;
	height:128px;
	z-index:1;
}
-->
</style>
</head>

<body>
	<div id="container">
    <div id="header">
        <h2>MARDILMS (Kursus Umum) - Technical Services</h2>
      </div>
      <div id="topmenu">
            	<ul>
                <li class="current"><a href="../admin/index.php">Dashboard</a></li>
                <li><a href="../admin/list-kursus.php">Kursus</a></li>
               	<li><a href="../admin/list-peserta.php">Peserta</a></li>
                <li><a href="../admin/list-kategori.php">Kategori</a></li>
                <li><a href="../admin/list-lokasi.php">Lokasi</a></li>
                <li><a href="../admin/laporan/report_kursus.php">Laporan</a></li>
                <li><a href="../login/logout.php">Keluar</a></li>
        </ul>
          </div>
          <div id="top-panel"></div>
	
      <div id="wrapper"><!-- InstanceBeginEditable name="content" -->
            <div id="content">
              <div id="box">
                <h3>Senarai Artikel</h3>
                <table class="sortable" width="100%">
                  <thead>
                    <tr>
                      <th width="44"><a href="#">ID</a></th>
                      <th width="377"><a href="#">Tajuk</a></th>
                      <th width="218"><a href="#">Tarik Kemaskini</a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                      <tr>
                        <td class="a-center"><?php echo $row_cms['cms_id']; ?></td>
                        <td><a href="cms-update.php?cms_id=<?php echo $row_cms['cms_id']; ?>"><?php echo $row_cms['cms_title']; ?></a></td>
                        <td><div align="center"><?php echo $row_cms['cms_lastupdate']; ?></div></td>
                      </tr>
                      <?php } while ($row_cms = mysql_fetch_assoc($cms)); ?>
                  </tbody>
                </table>
              </div>
              <br />
              <div id="box">
                <h3>Berita</h3>
                <table class="sortable" width="100%">
                  <thead>
                    <tr>
                      <th width="44"><a href="#">ID</a></th>
                      <th width="377"><a href="#">Tajuk</a></th>
                      <th width="218"><a href="#">Tarik Kemaskini</a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                    <tr>
                      <td class="a-center"><?php echo $row_berita['cms_id']; ?></td>
                      <td><a href="cms-update.php?cms_id=<?php echo $row_berita['cms_id']; ?>"><?php echo $row_berita['cms_title']; ?></a></td>
                      <td><div align="center"><?php echo $row_berita['cms_lastupdate']; ?></div></td>
                    </tr>
                      <?php } while ($row_berita = mysql_fetch_assoc($berita)); ?>
                  </tbody>
                </table>
              </div>
              <br />
              <div id="box">
                <h3 id="adduser">Tambah Artikel / Berita</h3>
                <form name="form" id="form" action="<?php echo $editFormAction; ?>" method="POST">
                  <fieldset id="personal">
                    <legend>Sila isi maklumat dibawah</legend>
                    <label for="kategori">Berita : </label>
                    <input name="kategori" type="radio" value="Y" />&nbsp;Ya
                    <input name="kategori" type="radio" value="N" />&nbsp;Tidak
                    <br />
                    <label for="title">Tajuk : </label>
                    <input name="title" type="text" id="title" tabindex="1" size="80" />
                    <br />
                    <label for="firstname">Kandungan : </label>
                    <textarea name="content" cols="50" rows="5" id="firstname" tabindex="2"></textarea>
                    <br />
                  </fieldset>
                  <div id="pager">
                  	<?php include "../admin/includes/button.html"; ?>
                  </div>
                  <input type="hidden" name="MM_insert" value="form" />
                </form>
                
              </div>
            </div>
            <!-- InstanceEndEditable -->
            <div id="sidebar">
              <ul>
                <li>
                  <h3><a href="#" class="house">Dashboard</a></h3>
                  <ul>
                    <li><a href="../admin/ringkasan.php" class="report">Ringkasan</a></li>
                    <li><a href="../admin/laporan/report_kursus.php" class="report_seo">Laporan</a></li>
                    <li><a href="../admin/finance.php" class="promotions">Kewangan</a></li>
                    <li><a href="#" class="search">Statistik</a></li>
                  </ul>
                </li>
                <li>
                  <h3><a href="#" class="folder_table">Kursus</a></h3>
                  <ul><?php require_once('../login/auth.php'); ?>
                  <?php if ($_SESSION['SESS_USERNAME']==admin){ 
				  	echo "<li><a href='../admin/tambah-kursus-admin.php' class='addorder'>Tambah Kursus</a></li>";
					} else {
					echo "<li><a href='../admin/tambah-kursus.php' class='addorder'>Tambah Kursus</a></li>";
					} ?>
                    <li><a href="../admin/tambah-kategori.php" class="addorder">Tambah Kategori</a></li>
                    <li><a href="../admin/tambah-lokasi.php" class="manage_page">Tambah Lokasi</a></li>
                    <li><a href="../admin/tambah-penaja.php" class="invoices">Tambah Penaja</a></li>
                  </ul>
                </li>
                <li>
                  <h3><a href="#" class="manage">Senarai</a></h3>
                  <ul>
                    <li><a href="../admin/list-kursus.php" class="addorder">Kursus</a></li>
                    <li><a href="../admin/list-penceramah.php" class="invoices">Penceramah</a></li>
                    <li><a href="../admin/list-topik.php" class="manage_page">Topik</a></li>
                    <li><a href="../admin/list-penaja.php" class="cart">Penaja</a></li>
                    <li><a href="../admin/list-kategori.php" class="folder">Kategori</a></li>
                    <li><a href="../admin/list-peserta.php" class="group">Peserta</a></li>
                    <li><a href="../admin/list-bayaran.php" class="promotions">Bayaran</a></li>
                    <li><a href="../admin/list-lokasi.php" class="manage_page">Lokasi</a></li>
                  </ul>
                </li>
                <li>
                  <h3><a href="#" class="user">Admin</a></h3>
                  <ul>
                  <?php if ($_SESSION['SESS_USERNAME']==admin){ 
				  	echo "<li><a href='../admin/tambah-admin.php' class='useradd'>Tambah Admin</a></li>";
                    echo "<li><a href='../admin/list.php' class='group'>Senarai Admin</a></li>";
					echo "<li><a href='../admin/cms.php' class='manage_page'>Artikel</a></li>";
					echo "<li><a href='../login/logout.php' class='online'>Log Keluar</a></li>";
					echo "<li><a href='?locale=ms_MY' class='online'>". _("Bahasa Melayu")."</a></li>";
					} else {
					echo "<li><a href='../admin/cms.php' class='manage_page'>Artikel</a></li>";
					echo "<li><a href='?locale=ms_MY' class='online'>". _("Bahasa Melayu")."</a></li>";
                    echo "<li><a href='../login/logout.php' class='online'>Log Keluar</a></li>";
					}
					?> 
                  </ul>
                </li>
              </ul>
            </div>
      </div>
          <div id="footer">
          <div id="credits">Hakcipta Terpelihara &copy; MARDILMS 2009-2011 | Tarikh kemaskini: <?php echo date("d/m/Y", time()); ?></div>
          
          <div id="styleswitcher">
            <ul>
              <li><a href="javascript: document.cookie='theme='; window.location.reload();" title="Default" id="defswitch">d</a></li>
              <li><a href="javascript: document.cookie='theme=1'; window.location.reload();" title="Blue" id="blueswitch">b</a></li>
              <li><a href="javascript: document.cookie='theme=2'; window.location.reload();" title="Green" id="greenswitch">g</a></li>
              <li><a href="javascript: document.cookie='theme=3'; window.location.reload();" title="Brown" id="brownswitch">b</a></li>
              <li><a href="javascript: document.cookie='theme=4'; window.location.reload();" title="Mix" id="mixswitch">m</a></li>
            </ul>
          </div>
          <br />
          
          </div>
</div></body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($cms);
mysql_free_result($berita);
?>
