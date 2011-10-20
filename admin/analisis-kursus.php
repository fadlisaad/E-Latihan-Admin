<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Penilaian Kursus.
 */
error_reporting(0);
require_once('../login/auth.php');
require_once('../Connections/ts_kursus.php');

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_berjadual = "SELECT ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_kod FROM ts_kursus WHERE ts_kursus.ts_kursus_vendor='Kursus Berjadual' ORDER BY ts_kursus_kod";
$berjadual = mysql_query($query_berjadual, $ts_kursus) or die(mysql_error());
$row_berjadual = mysql_fetch_assoc($berjadual);
$totalRows_berjadual = mysql_num_rows($berjadual);
isset($startRow_berjadual)? $orderNum=$startRow_berjadual:$orderNum=1;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_luar_jadual = "SELECT ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_kod FROM ts_kursus WHERE ts_kursus.ts_kursus_vendor='Kursus Luar Jadual' ORDER BY ts_kursus_kod";
$luar_jadual = mysql_query($query_luar_jadual, $ts_kursus) or die(mysql_error());
$row_luar_jadual = mysql_fetch_assoc($luar_jadual);
$totalRows_luar_jadual = mysql_num_rows($luar_jadual);
isset($startRow_luar_jadual)? $orderNum1=$startRow_luar_jadual:$orderNum1=1;
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
<script type="text/javascript">
<!--
/*
Credits: Bit Repository
Source: http://www.bitrepository.com/web-programming/ajax/username-checker.html 
*/

pic1 = new Image(16, 16); 
pic1.src = "check-username/loader.gif";

$(document).ready(function(){

$("#kursus_id").change(function() { 

var usr = $("#kursus_id").val();

if(usr.length >= 3)
{
$("#status").html('<img src="check-username/loader.gif" align="absmiddle">&nbsp;Semakan kod kursus...');

    $.ajax({  
    type: "POST",  
    url: "check-username/check.php",  
    data: "kursus_id="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#kursus_id").removeClass('object_error'); // if necessary
		$("#kursus_id").addClass("object_ok");
		$(this).html('&nbsp;<img src="check-username/tick.gif" align="absmiddle">');
		$("#status").show();
	}  
	else  
	{  
		$("#kursus_id").removeClass('object_ok'); // if necessary
		$("#kursus_id").addClass("object_error");
		$(this).html(msg);
		$("#status").hide();
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#status").html('<font color="red">Kursus <?php echo $row['ts_kursus_nama']; ?>.</font>');
	$("#kursus_id").removeClass('object_ok'); // if necessary
	$("#kursus_id").addClass("object_error");
	}

});

});

//-->
</script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Penilaian Kursus</title>
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
          <h2>Penilaian Kursus</h2>
		  <hr />
				<div align="left">
				<label for="filter">Masukkan #ID disini:</label>
					<input type="text" id="kursus_id" class="input-text"/><span id="status"></span>
				</div>
				
          <div class="tabs box">
            <ul>
              <li><a href="#tab01"><span>Kursus Berjadual</span></a></li>
              <li><a href="#tab02"><span>Kursus Luar Jadual</span></a></li>
            </ul>
          </div>
          <div id="tab01">
          <p>
		  <table width="100%">
            <tr>
              <th width="15" class="t-center">Bil.</th>
              <th width="70" class="t-center">Kod</th>
              <th>Tajuk Kursus</th>
              <th width="70" class="t-center">Laporan</th>
              <th width="70" class="t-center">Analisis</th>
            </tr>
            <?php do { ?>
            <tr>
              <td><?php echo $orderNum++; ?></td>
              <td class="t-center"><?php echo $row_berjadual['ts_kursus_kod']; ?></td>
              <td><?php echo $row_berjadual['ts_kursus_nama']; ?></td>
              <td class="t-center"><a href="laporan/laporan-penamatan.php?kursus_id=<?php echo $row_berjadual['ts_kursus_id']; ?>"><img src="img/icons/page.png" alt="Papar" width="16" height="16" /></a></td>
              <td class="t-center"><img src="img/icons/page.png" alt="Papar" width="16" height="16" /></td>
            </tr>
              <?php } while ($row_berjadual = mysql_fetch_assoc($berjadual)); ?>
          </table>
          </p>
          </div>
          <div id="tab02">
          <p>
          <table width="100%">
            <tr>
              <th width="15" class="t-center">Bil.</th>
              <th width="70" class="t-center">Kod</th>
              <th>Tajuk Kursus</th>
              <th width="70">Laporan</th>
              <th width="70">Analisis</th>
            </tr>
            <?php do { ?>
            <tr>
              <td class="t-center"><?php echo $orderNum1++; ?></td>
              <td class="t-center"><?php echo $row_luar_jadual['ts_kursus_kod']; ?></td>
              <td><?php echo $row_luar_jadual['ts_kursus_nama']; ?></td>
              <td class="t-center"><a href="laporan/laporan-penamatan.php?kursus_id=<?php echo $row_luar_jadual['ts_kursus_id']; ?>"><img src="img/icons/page.png" alt="Papar" width="16" height="16" /></a></td>
              <td class="t-center"><img src="img/icons/page.png" alt="Papar" width="16" height="16" /></td>
            </tr>
              <?php } while ($row_luar_jadual = mysql_fetch_assoc($luar_jadual)); ?>
          </table>
          </p>
          </div>
          <br />
          <div class="buttons"><a href="javascript:history.go(-1)">
          <img src="img/icons/arrow_undo.png" alt=""/>Kembali</a></div>
		  <!-- Form -->
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
mysql_free_result($berjadual);

mysql_free_result($luar_jadual);
?>