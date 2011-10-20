<?php require_once('../../Connections/ts_kursus.php'); ?>
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

$colname_check_email = "-1";
if (isset($_GET['ts_admin_ID'])) {
  $colname_check_email = $_GET['ts_admin_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_check_email = sprintf("SELECT * FROM ts_admin, ts_mail WHERE ts_admin_ID = %s", GetSQLValueString($colname_check_email, "int"));
$check_email = mysql_query($query_check_email, $ts_kursus) or die(mysql_error());
$row_check_email = mysql_fetch_assoc($check_email);
$totalRows_check_email = mysql_num_rows($check_email);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/elatihan/ts/templates/admin_main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Inbox</title>
<!-- InstanceEndEditable -->
<link rel="alternate" href="../../rss.php" title="E-Learning RSS" type="application/rss+xml" />  
<link rel="stylesheet" type="text/css" href="../css/theme1.css" />
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script>
   var StyleFile = "theme" + document.cookie.charAt(6) + ".css";
   document.writeln('<link rel="stylesheet" type="text/css" href="css/' + StyleFile + '">');
</script>
<script type="text/javascript" src="../script/datepicker.js"></script>
<script type="text/javascript" src="../../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "simple"
	});
</script>
<script type="text/javascript" src="../../js/sorttable/sorttable.js"></script>
<script type="text/javascript" src="../../js/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../../js/scriptaculous/src/scriptaculous.js"></script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --><!-- InstanceParam name="head" type="boolean" value="true" --><!-- InstanceParam name="menu" type="boolean" value="true" --><!-- InstanceParam name="menu_right" type="boolean" value="true" --><!-- InstanceParam name="footer" type="boolean" value="true" -->
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
                <li class="current"><a href="../index.php">Dashboard</a></li>
                <li><a href="../list-kursus.php">Kursus</a></li>
               	<li><a href="../list-peserta.php">Peserta</a></li>
                <li><a href="../list-kategori.php">Kategori</a></li>
                <li><a href="../list-lokasi.php">Lokasi</a></li>
                <li><a href="../laporan/report_kursus.php">Laporan</a></li>
                <li><a href="../../login/logout.php">Keluar</a></li>
        </ul>
          </div>
          <div id="top-panel"></div>
	
      <div id="wrapper"><!-- InstanceBeginEditable name="content" -->
            <div id="content">
              <div id="box">
                <h3>List of Message</h3>
                <table class="sortable" width="100%">
                  <thead>
                    <tr>
                      <th width="40"><a href="#">No</a></th>
                      <th><a href="#">From</a></th>
                      <th><a href="#">Title</a></th>
                      <th width="60"><a href="#">Date</a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                    <tr>
                      <td class="a-center">&nbsp;</td>
                      <td><a href="email_read.php?ts_email_id=<?php echo $row_check_email['ts_email_id']; ?>"><?php echo $row_check_email['ts_email_sender']; ?></a></td>
                      <td><?php echo $row_check_email['ts_email_subject']; ?></td>
                      <td nowrap="nowrap"><?php echo $row_check_email['ts_email_lastupdate']; ?></td>
                    </tr>
                      <?php } while ($row_check_email = mysql_fetch_assoc($check_email)); ?>
                  </tbody>
                </table>
                </div>
              <br />
            </div>
      <!-- InstanceEndEditable -->
            <div id="sidebar">
              <ul>
                <li>
                  <h3><a href="#" class="house">Dashboard</a></h3>
                  <ul>
                    <li><a href="../ringkasan.php" class="report">Ringkasan</a></li>
                    <li><a href="../laporan/report_kursus.php" class="report_seo">Laporan</a></li>
                    <li><a href="../finance.php" class="promotions">Kewangan</a></li>
                    <li><a href="#" class="search">Statistik</a></li>
                  </ul>
                </li>
                <li>
                  <h3><a href="#" class="folder_table">Kursus</a></h3>
                  <ul><?php require_once('../../login/auth.php'); ?>
                  <?php if ($_SESSION['SESS_USERNAME']==admin){ 
				  	echo "<li><a href='../admin/tambah-kursus-admin.php' class='addorder'>Tambah Kursus</a></li>";
					} else {
					echo "<li><a href='../admin/tambah-kursus.php' class='addorder'>Tambah Kursus</a></li>";
					} ?>
                    <li><a href="../tambah-kategori.php" class="addorder">Tambah Kategori</a></li>
                    <li><a href="../tambah-lokasi.php" class="manage_page">Tambah Lokasi</a></li>
                    <li><a href="../tambah-penaja.php" class="invoices">Tambah Penaja</a></li>
                  </ul>
                </li>
                <li>
                  <h3><a href="#" class="manage">Senarai</a></h3>
                  <ul>
                    <li><a href="../list-kursus.php" class="addorder">Kursus</a></li>
                    <li><a href="../list-penceramah.php" class="invoices">Penceramah</a></li>
                    <li><a href="../list-topik.php" class="manage_page">Topik</a></li>
                    <li><a href="../list-penaja.php" class="cart">Penaja</a></li>
                    <li><a href="../list-kategori.php" class="folder">Kategori</a></li>
                    <li><a href="../list-peserta.php" class="group">Peserta</a></li>
                    <li><a href="../list-bayaran.php" class="promotions">Bayaran</a></li>
                    <li><a href="../list-lokasi.php" class="manage_page">Lokasi</a></li>
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
mysql_free_result($check_email);
?>
