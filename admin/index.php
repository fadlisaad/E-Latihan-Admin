<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Index page for admin.
 */

require_once('../Connections/ts_kursus.php');
require_once('../login/auth.php');
require_once('../include/paginator.php');

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


$colname_admin = "-1";
if (isset($_SESSION['SESS_ADMIN_ID'])) {
  $colname_admin = $_SESSION['SESS_ADMIN_ID'];
}

// total paging
if (isset($_GET['id'])) {
	$thisyear	= $_GET['id'];
	}
else {
	$thisyear	= date('Y');
	}
	
	$query 				= "SELECT COUNT(*) FROM ts_kursus WHERE ts_kursus_year = $thisyear";
	$result 			= mysql_query($query) or die(mysql_error());
	$num_rows 			= mysql_fetch_row($result);
	
	$pages 				= new Paginator;
	$pages->items_total = $num_rows[0];
	$pages->mid_range 	= 15; // Number of pages to display. Must be odd and > 3
	$pages->paginate();

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_admin = sprintf("SELECT * FROM ts_admin, ts_kursus WHERE ts_admin_ID = %s AND ts_kursus.ts_kursus_admin = %s AND ts_kursus.ts_kursus_year = $thisyear ORDER BY ts_kursus.ts_kursus_kod ASC ".$pages->limit."", GetSQLValueString($colname_admin, "int"),GetSQLValueString($colname_admin, "int"));
$admin = mysql_query($query_admin, $ts_kursus) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);

if (isset($_GET['totalRows_admin'])) {
  $totalRows_admin = $_GET['totalRows_admin'];
} else {
  $all_admin = mysql_query($query_admin);
  $totalRows_admin = mysql_num_rows($all_admin);
}
$totalPages_admin = ceil($totalRows_admin/$maxRows_admin)-1;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_check_email = "SELECT ts_admin.ts_admin_email, COUNT(ts_mail.ts_email_address), ts_admin.ts_admin_ID FROM ts_admin, ts_mail WHERE ts_admin.ts_admin_email=ts_mail.ts_email_address GROUP BY (ts_mail.ts_email_address)";
$check_email = mysql_query($query_check_email, $ts_kursus) or die(mysql_error());
$row_check_email = mysql_fetch_assoc($check_email);
$totalRows_check_email = mysql_num_rows($check_email);

$today_date = date('Y-m-d');
$colname_new = "-1";
if (isset($today_date)) {
  $colname_new = $today_date;
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_new = sprintf("SELECT COUNT(ts_invoice.peserta_id) as peserta FROM ts_invoice WHERE lastupdate = %s", GetSQLValueString($colname_new, "text"));
$new = mysql_query($query_new, $ts_kursus) or die(mysql_error());
$row_new = mysql_fetch_assoc($new);
$totalRows_new = mysql_num_rows($new);

isset($startRow_admin)? $orderNum=$startRow_admin:$orderNum=0;

$queryString_admin = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_admin") == false && 
        stristr($param, "totalRows_admin") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_admin = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_admin = sprintf("&totalRows_admin=%d%s", $totalRows_admin, $queryString_admin);
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
<link rel="stylesheet" type="text/css" href="../js/datepicker.css" />
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
<script type="text/javascript">
	function redirect() {
	if (window.location.search.length <= 1) {
		window.location.href = "index.php?id=<?php echo $thisyear; ?>";
	}
}
</script>
<script type="text/javascript">

pic1 = new Image(16, 16); 
pic1.src = "check-username/loader.gif";

$(document).ready(function(){
	$(".tabs > ul").tabs();
	$("#kod_kursus").change(function() { 
		var usr = $("#kod_kursus").val();
		if(usr.length >= 3)
		{
			$("#status").html('<img src="check-username/loader.gif" align="absmiddle">&nbsp;Carian kursus...');
				$.ajax({  
				type: "POST",  
				url: "check-username/cari-kursus.php",  
				data: "kod_kursus="+ usr,  
				success: function(msg)
				{
					$("#status").ajaxComplete(function(event, request, settings)
					{ 
						if(msg == 'OK')
						{ 
							$("#kod_kursus").removeClass('object_error'); // if necessary
							$("#kod_kursus").addClass("object_ok");
							$(this).html('<p class="msg error">Tiada kursus dengan kod berkenaan. Sila cuba semula</p>');
							//$(this).html('&nbsp;<img src="check-username/tick.gif" align="absmiddle">');
							$("#pager").show();
						}  
						else  
						{  
							$("#kod_kursus").removeClass('object_ok'); // if necessary
							$("#kod_kursus").addClass("object_error");
							$(this).html(msg);
							$("#pager").hide();
						}
					});
				} 
			});
		}
		else
			{
				$("#status").html('<font color="red">Kursus: </font>');
				$("#kod_kursus").removeClass('object_ok'); // if necessary
				$("#kod_kursus").addClass("object_error");
			}
	});
});
</script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Halaman Utama</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --><!-- InstanceParam name="sidebar" type="boolean" value="true" --><!-- InstanceParam name="footer" type="boolean" value="true" --><!-- InstanceParam name="header" type="boolean" value="true" -->
</head>

<body onLoad="redirect()">
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
        <h3>Selamat kembali, <?php echo $_SESSION['SESS_FULLNAME'];?></h3>
        <p class="msg info">Terdapat <strong><?php echo $row_new['peserta']; ?></strong> pendaftaran baru hari ini</p>
            <div class="fix"></div>
			<p><strong>Carian Kursus:&nbsp;</strong><input type="text" id="kod_kursus" class="input-text" AUTOCOMPLETE=OFF></p><span id="status"></span>
			<h3>Senarai Kursus mengikut kluster (<?php echo $thisyear; ?>)</h3>
              <div class="buttons">
              <a href="list-kursus-kategori.php?ts_kursus_kategori=Teknologi Tanaman&amp;year=<?php echo $thisyear; ?>">
              <img src="img/icons/note.png" alt=""/>Teknologi Tanaman</a></div>
              <div class="buttons">
              <a href="list-kursus-kategori.php?ts_kursus_kategori=Teknologi Ternakan&amp;year=<?php echo $thisyear; ?>">
              <img src="img/icons/note.png" alt=""/>Teknologi Ternakan</a></div>
              <div class="buttons">
              <a href="list-kursus-kategori.php?ts_kursus_kategori=Teknologi Makanan&amp;year=<?php echo $thisyear; ?>">
              <img src="img/icons/note.png" alt=""/>Teknologi Makanan</a></div>
              <div class="buttons">
              <a href="list-kursus-kategori.php?ts_kursus_kategori=Teknologi Lanjutan&amp;year=<?php echo $thisyear; ?>">
              <img src="img/icons/note.png" alt=""/>Teknologi Lanjutan</a></div>
              <div class="fix"></div>
            <h3>Senarai Kursus tahun <?php echo $thisyear; ?></h3>
			<div class="buttons"><a href="#"><img src="img/icons/magnifier.png" alt=""/>Pilih tahun&nbsp;&raquo;</a></div>
			<?php for($year = 2009; $year < 2012; $year++) { ?>
			<div class="buttons">
			  <a href="index.php?id=<?php echo $year ?>">
			  <img src="img/icons/date.png" alt=""/><?php echo $year ?></a>
			</div>
			<?php } ?>
			<br /><br />
			<?php if($row_admin > 0) { ?>
			<p class="msg warning"><strong>Perhatian</strong>: Klik pada ruangan 'Duplicate' untuk copy maklumat kursus ke tahun berikutnya.</p>
            <table width="100%">
				<thead>
					<tr>
						<th width="15" class="t-center">Bil.</th>
						<th width="60" class="t-center">Kod</th>
						<th>Tajuk Kursus</th>
						<th width="150" class="t-center">Kluster</th>
						<th width="60" class="t-center">Tahun</th>
						<th width="100" class="t-center">Duplicate</th>
						<th width="50" class="t-center">Delete</th>
					</tr>
				</thead>
				<tbody>
				<?php $orderNum = $_GET['ipp']*($_GET['page']-1); ?>
                <?php do { ?>
					<tr class="t-center">
						<td class="t-center"><?php echo ++$orderNum; ?></td>
						<td class="t-center"><?php echo $row_admin['ts_kursus_kod']; ?></td>
						<td class="t-left">
							<a href="list-peserta-kursus.php?ts_kursus_id=<?php echo $row_admin['ts_kursus_id']; ?>"><?php echo strtoupper($row_admin['ts_kursus_nama']); ?></a>
						</td>
						<td class="t-center"><?php echo $row_admin['ts_kursus_kategori']; ?></td>
						<td class="t-center"><?php echo $row_admin['ts_kursus_year']; ?></td>
						<td class="t-center"><a href="../include/duplicate.php?id=<?php echo $row_admin['ts_kursus_id']; ?>&amp;year=<?php echo $thisyear+1 ?>"><?php echo $thisyear+1 ?></a></td>
						<td class="t-center"><a href="padam-kursus.php?id=<?php echo $row_admin['ts_kursus_id']; ?>" onClick="javascript: return confirm('Anda pasti ingin memadam rekod kursus ini? \nKlik OK untuk padam. \nKlik CANCEL untuk kembali.');"><img src="img/icons/delete.png" alt="Padam"/></a></td>
					</tr>
				<?php } while ($row_admin = mysql_fetch_assoc($admin)); ?>
				</tbody>
			</table>
			<hr />
				<?php echo $pages->display_pages(); ?>
			<?php } else { ?>
				<p class="msg error">Tiada kursus pada tahun ini.</p>
			<?php } ?>
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
mysql_free_result($admin);
mysql_free_result($check_email);
mysql_free_result($new);
?>
