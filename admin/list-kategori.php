<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Listing of category.
 */

error_reporting(0);

require_once('../login/auth.php'); 
require_once('../Connections/ts_kursus.php');

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_add_kategori = "SELECT * FROM ts_kategori";
$add_kategori = mysql_query($query_add_kategori, $ts_kursus) or die(mysql_error());
$row_add_kategori = mysql_fetch_assoc($add_kategori);
$totalRows_add_kategori = mysql_num_rows($add_kategori);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_sum_kategori = "SELECT COUNT(ts_kategori_ID) FROM ts_kategori GROUP BY ts_kategori_year";
$sum_kategori = mysql_query($query_sum_kategori, $ts_kursus) or die(mysql_error());
$row_sum_kategori = mysql_fetch_assoc($sum_kategori);
$totalRows_sum_kategori = mysql_num_rows($sum_kategori);

isset($startRow_add_kategori)? $orderNum=$startRow_add_kategori:$orderNum=0;
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
<!-- JAVASCRIPTS -->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/switcher.js"></script>
<script type="text/javascript" src="../js/toggle.js"></script>
<script type="text/javascript" src="../js/ui.core.js"></script>
<script type="text/javascript" src="../js/ui.tabs.js"></script>
<script type="text/javascript" src="script/jquery.jeditable.mini.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	$(".tabs > ul").tabs();
		
	$('.kategori').editable('save-kategori.php', {
		 id			: 'id',
		 submit 	: 'Save'
	});	
});
</script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Senarai Kluster Kursus</title>
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
            <div id="content">
             <h3>Kluster Kursus </h3>
			 <hr />
             <div class="buttons">
              <a href="tambah-kategori.php">
              <img src="img/icons/add.png" alt=""/>Tambah Kluster</a></div>
              <div class="buttons">
              <a href="javascript:history.go(-1)">
              <img src="img/icons/arrow_undo.png" alt=""/>Kembali</a></div>
              <div class="fix"></div>
             <p class="msg info">Terdapat <?php echo $row_sum_kategori['COUNT(ts_kategori_ID)']; ?> kluster dalam sistem ini sekarang. Klik pada kategori untuk mengubah</p>
                 
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <th width="5%" class="t-center"><strong>Bil</strong></th>
                  <th>Nama Kategori</th>
				  <th width="120" class="t-center">Senarai Kursus</th>
                  <th width="40" class="t-center">Padam</th>
                  </tr>
                <?php do { ?>
                  <tr>
                    <td width="5%" class="t-center"><?php echo ++$orderNum; ?></td>
            <td><a href="#"><div class="kategori" id="<?php echo $row_add_kategori['ts_kategori_ID']; ?>"><?php echo $row_add_kategori['ts_kategori_nama']; ?></div></a></td>
			<td class="t-center">
			<a href="list-kursus-kategori.php?ts_kursus_kategori=<?php echo $row_add_kategori['ts_kategori_nama']; ?>">Papar</a></td>
            <td class="t-center"><a href="padam-kategori.php?ts_kategori_ID=<?php echo $row_add_kategori['ts_kategori_ID']; ?>" onClick="javascript: return confirm('Anda pasti ingin memadam kluster ini? \nKlik OK untuk padam. \nKlik CANCEL untuk kembali.');"><img src="img/icons/delete.png" title="Delete" width="16" height="16" /></a></td>
          </tr>
                  <?php } while ($row_add_kategori = mysql_fetch_assoc($add_kategori)); ?>
              </table>

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
mysql_free_result($add_kategori);
mysql_free_result($sum_kategori);
?>