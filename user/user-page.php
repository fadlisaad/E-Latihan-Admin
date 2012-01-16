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

$colname_user_details = "-1";
if (isset($_GET['ts_peserta_ID'])) {
  $colname_user_details = $_GET['ts_peserta_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_user_details = sprintf("SELECT * FROM ts_peserta WHERE ts_peserta_ID = %s", GetSQLValueString($colname_user_details, "int"),GetSQLValueString($colname_user_details, "int"));
$user_details = mysql_query($query_user_details, $ts_kursus) or die(mysql_error());
$row_user_details = mysql_fetch_assoc($user_details);
$totalRows_user_details = mysql_num_rows($user_details);

isset($startRow_user_details)? $orderNum=$startRow_user_details:$orderNum=0;

$colname_kursus = "-1";
if (isset($_GET['ts_peserta_ID'])) {
  $colname_kursus = $_GET['ts_peserta_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus = sprintf("SELECT * FROM ts_peserta, ts_kursus, ts_invoice WHERE ts_peserta.ts_peserta_ID = %s AND ts_invoice.kursus_id=ts_kursus.ts_kursus_id AND ts_invoice.peserta_id=ts_peserta.ts_peserta_ID", GetSQLValueString($colname_kursus, "int"),GetSQLValueString($colname_kursus, "int"));
$kursus = mysql_query($query_kursus, $ts_kursus) or die(mysql_error());
$row_kursus = mysql_fetch_assoc($kursus);
$totalRows_kursus = mysql_num_rows($kursus);

isset($startRow_kursus)? $orderNum=$startRow_kursus:$orderNum=0;

$colname_padam = "-1";
if (isset($_GET['ts_peserta_ID'])) {
  $colname_padam = $_GET['ts_peserta_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_padam = sprintf("SELECT id FROM ts_pictures WHERE files_id=%s", GetSQLValueString($colname_padam, "int"));
$padam = mysql_query($query_padam, $ts_kursus) or die(mysql_error());
$row_padam = mysql_fetch_assoc($padam);
$totalRows_padam = mysql_num_rows($padam);

$query="SELECT peserta_id FROM ts_invoice WHERE peserta_id=".$_GET['ts_peserta_ID']."";
$result=mysql_query($query);
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
$(document).ready(function() {
	$(".tabs > ul").tabs();
});

</script>
<script type="text/javascript" src="../js/datepicker.js"></script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Biodata Pengguna Berdaftar</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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
        <li><div class="buttons"><a href="tambah-kursus.php"><img src="../admin/img/icons/add.png" alt=""/>Kursus</a></div></li>
        <li><div class="buttons"><a href="tambah-lokasi.php"><img src="../admin/img/icons/add.png" alt=""/>Lokasi</a></div></li>
        <li><div class="buttons"><a href="tambah-kategori.php"><img src="../admin/img/icons/add.png" alt=""/>Kluster</a></div></li>
        <li><div class="buttons"><a href="tambah-admin.php"><img src="../admin/img/icons/add.png" alt=""/>Penyelaras</a></div></li>
      </ul>
    </div>

	
	<!-- /header -->

<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		
		<div id="aside" class="box">
          <ul class="box">
          <li id="submenu-active"><a href="../admin/index.php">Halaman Utama</a></li>
			<li id="submenu-active"><a href="#">Kursus</a>
                <ul>
                	<li><a href="../admin/list-kategori.php">Senarai Kluster</a></li>
                  <li><a href="../admin/list-kursus.php">Senarai Kursus</a></li>
                  <li><a href="../admin/list.php">Senarai Penyelaras</a></li>
                  <li><a href="../admin/list-peserta.php">Senarai Peserta</a></li>
                  <li><a href="../admin/list-penceramah.php">Senarai Penceramah</a></li>
                  <li><a href="../admin/list-topik.php">Senarai Topik</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Kewangan</a>
                <ul>
                	<li><a href="../admin/list-bayaran.php">Honorarium</a></li>
                    <li><a href="../admin/list-bayaran-kursus.php">Penyata Perbelanjaan</a></li>
                    <li><a href="../admin/list-bayaran-pendahuluan.php">Bayaran Pendahuluan</a></li>
                    <li><a href="../admin/list-bayaran-invoice.php">Invois</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Rekod Kursus</a>
                <ul>
                	<li><a href="../admin/analisis-kursus.php">Penilaian Kursus</a></li>
                    <li><a href="../admin/analisis-penceramah.php">Penilaian Penceramah</a></li>
                    <li><a href="../admin/analisis-peserta.php">Analisis Peserta</a></li>
                    <li><a href="../admin/analisis-bayaran.php">Analisis Kluster</a></li>
                    <li><a href="../admin/analisis-bulanan.php">Analisis Bulanan</a></li>
                </ul>
            </li>
            </ul>
	    </div>
		
		<!-- /aside -->

    <hr class="noscreen" />

		<!-- Content (Right Column) -->
		<!-- InstanceBeginEditable name="content" -->
            <div id="content">
			
            <h3>Nama: <?php echo strtoupper($row_user_details['ts_peserta_nama']); ?></h3>
            <div class="tabs box">
            <ul>
              <li><a href="#tab01"><span>Biodata</span></a></li>
              <li><a href="#tab02"><span>Kursus</span></a></li>
            </ul>
          </div>
          <div id="tab01">
          <div class="col50">
            <fieldset>
            <legend>Biodata</legend>
              
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="nostyle">
                <tr>
                  <td width="30%"><strong>No Kad Pengenalan<br />
                  </strong></td>
              <td><?php echo $row_user_details['ts_peserta_ic']; ?></td>
            </tr>
                <tr>
                  <td width="30%"><strong>No Telefon Bimbit</strong></td>
              <td><?php echo $row_user_details['ts_peserta_handfone']; ?></td>
            </tr>
                <tr>
                  <td width="30%"><strong>No Telefon Rumah</strong></td>
              <td><?php echo $row_user_details['ts_peserta_homeline']; ?></td>
            </tr>
                <tr>
                  <td width="30%"><strong>Alamat</strong></td>
              <td><?php echo strtoupper($row_user_details['ts_peserta_alamat']); ?></td>
            </tr>
                <tr>
                  <td width="30%"><strong>E-mail</strong></td>
              <td><?php echo $row_user_details['ts_peserta_email']; ?></td>
            </tr>
                <tr>
                  <td width="30%"><strong>Status</strong></td>
                  <td><?php if ($row_user_details['active'] != 0) {
									echo "Aktif<br />";
									}
									else {
									echo "Belum aktif. Klik pada butang 'E-mail' untuk menghantar pengesahan semula <div class='buttons'><a href=\"../admin/includes/sendmail.php?ts_peserta_ID=".$row_user_details['ts_peserta_ID']."\">
													   <img src='../admin/img/icons/email.png' />E-mail</a>
													</div>";
									}
						?></td>
                </tr>
              </table>
            </fieldset>
              </div>
              <div class="col50 f-right">
              <fieldset>
              <legend>Gambar</legend>
              <table width="100%" class="nostyle">
                <tr>
                  <td><a href="../view-files.php?id=<?php echo $row_user_details['ts_peserta_ID']; ?>"><img src="../view-files.php?id=<?php echo $row_user_details['ts_peserta_ID']; ?>" alt="-Tiada gambar-" width="200" /></a></td>
                </tr>
                <tr>
                  <td>
				  <?php if ( $row_padam['id'] !='') {
				  echo '<div class="buttons"><a href="padam-upload.php?id='.$row_padam['id'].'&ts_peserta_ID='.$row_user_details['ts_peserta_ID'].'" onClick="javascript: return confirm(\'Are you SURE you wish to do this? \nClick OK to delete this file. \nClick CANCEL to return to previous page.\');"><img src="../admin/img/icons/delete.png" width="16" height="16" title="Padam fail" />Padam gambar</a></div>';
				  }
				  else {
				  echo '<div class="buttons" onclick="MM_openBrWindow(\'upload.php?ts_peserta_ID='.$row_user_details['ts_peserta_ID'].'\',\'Upload\',\'width=300,height=200\')">
              <a href="#"><img src="../admin/img/icons/disk.png" alt=""/>Muat-naik gambar</a></div>'; } ?></td>
                </tr>
                <tr>
                  <td></td>
                </tr>
              </table></p>
              </fieldset>
              </div>
              <div class="fix"></div>
              <div class="col50">
              <fieldset>
              <legend>Maklumat Lain</legend>
              
              <table width="100%" class="nostyle">
                <tr>
                  <td width="30%"><strong>Jantina</strong></td>
                  <td><?php echo strtoupper($row_user_details['ts_peserta_jantina']); ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>Taraf perkahwinan</strong></td>
                  <td><?php echo strtoupper($row_user_details['ts_peserta_perkahwinan']); ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>Pendidikan</strong></td>
                  <td><?php echo strtoupper($row_user_details['ts_peserta_pendidikan']); ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>Pekerjaan</strong></td>
                  <td><?php echo strtoupper($row_user_details['ts_peserta_pekerjaan']); ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>Perniagaan</strong></td>
                  <td><?php echo strtoupper($row_user_details['ts_peserta_perusahaan']); ?></td>
                </tr>
              </table>
              </fieldset>
              </div>
              <div class="col50 f-right">
              <fieldset>
              <legend>Majikan</legend>
              <table width="100%" class="nostyle">
                <tr>
                  <td width="30%"><strong>Nama</strong></td>
                  <td><?php echo strtoupper($row_user_details['ts_majikan_nama']); ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>Alamat</strong></td>
                  <td><?php echo strtoupper($row_user_details['ts_majikan_alamat']); ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>Telefon</strong></td>
                  <td><?php echo $row_user_details['ts_majikan_telefon']; ?></td>
                </tr>
              </table>
              </fieldset>
              </div>
              </div>
              <div id="tab02">
              <h3>Senarai Kursus Disertai</h3>
              <table width="100%">
                <tr>
                <th width="15" class="t-center">Bil</th>
                <th>Tajuk Kursus </th>
				<th class="t-center">Tahun</th>
				<th class="t-center">Status</th>
				<th>Tindakan</th>
                </tr>
				<?php do { ?>
                <tr>
					<td width="15" class="t-center"><?php echo ++$orderNum; ?></td>
					<td><a href="../admin/list-peserta-kursus.php?ts_kursus_id=<?php echo $row_kursus['ts_kursus_id']; ?>"><?php echo strtoupper($row_kursus['ts_kursus_nama']); ?></a></td>
					<td class="t-center"><?php echo $row_kursus['ts_kursus_year']; ?></td>
					<td class="t-center"><?php if ($row_kursus['status'] == '1') {
							echo "<img src=\"../admin/img/icons/tick.png\" alt=\"Aktif\"/>";
							}
							else {
							echo "<img src=\"../admin/img/icons/cross.png\" alt=\"Belum aktif\"/>";
							} ?>
					</td>
					<td class="t-center"><a href="includes/sendmail.php?ts_peserta_ID=<?php echo $row_user_details['ts_peserta_ID']; ?>"><img src="../admin/img/icons/email.png" /></a></td>
                </tr>
				<?php } while ($row_kursus = mysql_fetch_assoc($kursus)); ?>
              </table>
              </div>
              <div class="fix"></div>
              <p>&nbsp;</p>
			  
			  <div class="buttons">
				<a href="ubah-peserta.php?id=<?php echo $row_user_details['ts_peserta_ID']; ?>"><img src="../admin/img/icons/tick.png" width="16" height="16" title="Padam fail" />Ubah Biodata</a></div>
              <div class="buttons">
				<a href="javascript:history.go(-1)"><img src="../admin/img/icons/arrow_undo.png" alt=""/>Kembali</a>
			</div>
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
mysql_free_result($user_details);
mysql_free_result($padam);
mysql_free_result($kursus);
?>
