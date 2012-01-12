<?php 
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Senarai latihan, peserta dan penceramah.
 */
require_once('../login/auth.php');
require_once('../Connections/ts_kursus.php');

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

// maklumat latihan
$colname_list_peserta = "-1";
if (isset($_GET['ts_latihan_id'])) {
  $colname_list_peserta = $_GET['ts_latihan_id'];
  $id = $_GET['ts_latihan_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_list_peserta = sprintf("SELECT * FROM ts_latihan WHERE ts_latihan.ts_latihan_id=%s", GetSQLValueString($colname_list_peserta, "int"));
$list_peserta = mysql_query($query_list_peserta, $ts_kursus) or die(mysql_error());
$row_list_peserta = mysql_fetch_assoc($list_peserta);
$totalRows_list_peserta = mysql_num_rows($list_peserta);

// senarai peserta
$colname_peserta = "-1";
if (isset($_GET['ts_latihan_id'])) {
  $colname_peserta = $_GET['ts_latihan_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_peserta = sprintf("SELECT ts_peserta.ts_peserta_nama nama, ts_peserta.ts_peserta_ic ic, ts_latihan.ts_latihan_id, ts_peserta.ts_peserta_ID, ts_status.status status, ts_invoice.peserta_id, ts_invoice.kursus_id FROM ts_latihan, ts_peserta LEFT JOIN ts_invoice ON ts_peserta.ts_peserta_ID = ts_invoice.peserta_id LEFT JOIN ts_status ON ts_invoice.status = ts_status.id WHERE ts_invoice.kursus_id = %s AND ts_latihan.ts_latihan_id=ts_invoice.kursus_id", GetSQLValueString($colname_peserta, "int"));
$peserta = mysql_query($query_peserta, $ts_kursus) or die(mysql_error());
$row_peserta = mysql_fetch_assoc($peserta);
$totalRows_peserta = mysql_num_rows($peserta);

// topik ceramah dan honorarium
$colname_list_topic = "-1";
if (isset($_GET['ts_latihan_id'])) {
  $colname_list_topic = $_GET['ts_latihan_id'];
}

// Ceramah
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_list_topic = sprintf("SELECT ts_topic.topic_id, ts_topic.topic_instructor, ts_topic.topic_title, ts_topic.topic_status, ts_topic.topic_date_start, ts_topic.topic_date_end, ts_topic.topic_rate, ts_topic.topic_hour, ts_topic.topic_rate*ts_topic.topic_hour AS jumlah , ts_instructor.instruct_id FROM ts_topic, ts_instructor WHERE ts_topic.topic_status = %s AND ts_topic.topic_instructor = ts_instructor.instruct_name", GetSQLValueString($colname_list_topic, "int"));
$list_topic = mysql_query($query_list_topic, $ts_kursus) or die(mysql_error());
$row_list_topic = mysql_fetch_assoc($list_topic);
$totalRows_list_topic = mysql_num_rows($list_topic);

// Honorarium
$query_honorarium = sprintf("SELECT ts_topic.topic_id, ts_topic.topic_instructor, ts_topic.topic_title, ts_topic.topic_status, ts_topic.topic_date_start, ts_topic.topic_date_end, ts_topic.topic_rate, ts_topic.topic_hour, ts_topic.topic_rate*ts_topic.topic_hour AS jumlah , ts_instructor.instruct_id FROM ts_topic, ts_instructor WHERE ts_topic.topic_status = %s AND ts_topic.topic_instructor = ts_instructor.instruct_name", GetSQLValueString($colname_list_topic, "int"));
$honorarium = mysql_query($query_honorarium, $ts_kursus) or die(mysql_error());
$row_honorarium = mysql_fetch_assoc($honorarium);
$totalRows_honorarium = mysql_num_rows($honorarium);

$query_total_honorarium = sprintf("SELECT SUM(topic_hour) AS total_hour, SUM(topic_rate*topic_hour) AS jumlah FROM ts_topic WHERE topic_status = %s", GetSQLValueString($colname_list_topic, "int"));
$honorarium_total = mysql_query($query_total_honorarium, $ts_kursus) or die(mysql_error());
$row_honorarium_total = mysql_fetch_assoc($honorarium_total);

// brosur
$colname_brosur = "-1";
if (isset($_GET['ts_latihan_id'])) {
  $colname_brosur = $_GET['ts_latihan_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_brosur = sprintf("SELECT * FROM ts_files WHERE files_id = %s", GetSQLValueString($colname_brosur, "int"));
$brosur = mysql_query($query_brosur, $ts_kursus) or die(mysql_error());
$row_brosur = mysql_fetch_assoc($brosur);
$totalRows_brosur = mysql_num_rows($brosur);

if (isset($_GET['ts_latihan_id'])) {
  $id = $_GET['ts_latihan_id'];
}
// bayaran pendahuluan
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_rekod = "SELECT ts_admin.ts_admin_nama, ts_advance.ts_advance_tarikh_ambil, ts_advance.ts_advance_tarikh_kembali, ts_advance.ts_advance_jumlah";
$query_rekod .= " FROM ts_advance, ts_admin, ts_latihan";
$query_rekod .= " WHERE ts_advance.ts_advance_penyelaras_id = ts_admin.ts_admin_ID";
$query_rekod .= " AND ts_advance.ts_advance_kursus_id = ts_latihan.ts_latihan_ID";
$query_rekod .= " AND ts_advance.ts_advance_kursus_id = ".$id."";
$rekod = mysql_query($query_rekod, $ts_kursus) or die(mysql_error());
$row_rekod = mysql_fetch_assoc($rekod);
$totalRows_rekod = mysql_num_rows($rekod);

// total bayaran pendahuluan
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_pendahuluan = "SELECT SUM(ts_advance_jumlah) AS jumlah FROM ts_advance WHERE ts_advance_kursus_id = $id";
$pendahuluan = mysql_query($query_pendahuluan, $ts_kursus) or die(mysql_error());
$row_pendahuluan = mysql_fetch_assoc($pendahuluan);
$totalRows_pendahuluan = mysql_num_rows($pendahuluan);

isset($startRow_list_peserta)? $orderNum=$startRow_list_peserta:$orderNum=0;
isset($startRow_list_topic)? $orderNum1=$startRow_list_topic:$orderNum1=0;

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
<script type="text/javascript" src="script/jquery.jeditable.mini.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".tabs > ul").tabs();
	$('.status').editable('save-status.php', {
		 id			: 'id',
		 submitdata	: {kursus:'<?php echo $row_peserta['ts_kursus_id']; ?>'},
		 indicator 	: 'Saving...',
         tooltip   	: 'Click to edit...',
		 data   	: "{'1':'Permohonan Baru','2':'Dalam Proses','3':'Diterima', '4':'Batal','selected':'1'}",
		 type   	: 'select',
		 submit 	: 'OK',
		 style  	: 'inherit'
	});	
});
</script>
<script type="text/javascript" src="../js/datepicker.js"></script>
<!-- END OF HEADER -->
<title>Senarai Peserta Latihan Amali Mengikut Tajuk</title>
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
    <div id="content">
        <h3><?php echo strtoupper($row_list_peserta['ts_latihan_nama']); ?> (<?php echo $row_list_peserta['ts_latihan_kod']; ?>)<span style="float:right">
		<div class="buttons">
            <a href="#"><img src="img/icons/date.png" alt=""/><?php echo $row_list_peserta['ts_latihan_year']; ?></a>
		</div></span></h3>
		<hr />
		<div class="tabs box">
            <ul>
				<li><a href="#kursus"><span>Keterangan</span></a></li>
				<li><a href="#ceramah"><span>Ceramah</span></a></li>
				<li><a href="#honorarium"><span>Honorarium</span></a></li>
				<li><a href="#peserta"><span>Peserta</span></a></li>
				<li><a href="#pendahuluan"><span>Pendahuluan</span></a></li>
            </ul>
        </div>
        <div id="kursus">   
            <table width="100%" class="nostyle">
                <tr>
					<td width="10%"><strong>Tahun</strong></td>
					<td width="73%"><?php echo $row_list_peserta['ts_latihan_year']; ?></td>
				</tr>
                <tr>
                  <td><strong>Kod</strong></td>
                  <td><?php echo $row_list_peserta['ts_latihan_kod']; ?></td>
                </tr>
				<tr>
					<td><strong>Kategori</strong></td>
					<td><?php echo $row_list_peserta['ts_latihan_vendor']; ?></td>
				</tr>
                <tr>
                  <td><strong>Kluster</strong></td>
                  <td><?php echo $row_list_peserta['ts_latihan_kategori']; ?></td>
                </tr>
				<tr>
                  <td><strong>Tahun</strong></td>
                  <td><?php echo $row_list_peserta['ts_latihan_year']; ?></td>
                </tr>
                <tr>
                  <td><strong>Tempat</strong></td>
                  <td><?php echo $row_list_peserta['ts_latihan_lokasi']; ?></td>
                </tr>
                <tr>
                  <td><strong>Tarikh</strong></td>
                  <td><?php 
					if($row_list_peserta['ts_latihan_tarikh_mula'] && $row_list_peserta['ts_latihan_tarikh_tamat'] != '0000-00-00') {
						echo date("d F Y",strtotime($row_list_peserta['ts_latihan_tarikh_mula'])); ?> hingga <?php echo date("d F Y",strtotime($row_list_peserta['ts_latihan_tarikh_tamat']));
					}
					else {
						echo "<span style=\"color:red\">Tarikh akan ditentukan kelak.</span>";
					} ?></td>
                </tr>
				<?php 
				if($row_list_peserta['ts_latihan_vendor'] == 'Kursus Luar Jadual') { 
					echo "<tr><td colspan='2'>&nbsp;</td></tr>";
				}
				else { ?>
                <tr>
                  <td><strong>Tarikh tutup</strong></td>
                  
                  <td><?php if($row_list_peserta['ts_latihan_jadual'] != '0000-00-00') { echo date("d F Y",strtotime($row_list_peserta['ts_latihan_jadual'])); } else {
						echo "<span style=\"color:red\">Tarikh akan ditentukan kelak.</span>"; } ?></td>
                </tr>
                <tr>
                  <td><strong>Tarikh paparan</strong></td>

                  <td><?php if($row_list_peserta['ts_latihan_pubdate'] != '0000-00-00') { echo date("d F Y",strtotime($row_list_peserta['ts_latihan_pubdate'])); } else {
						echo "<span style=\"color:red\">Tarikh akan ditentukan kelak.</span>"; } ?></td>
                </tr>
				<?php } ?>
                <tr>
                  <td><strong>Yuran</strong></td>
                  <td>RM <?php echo number_format($row_list_peserta['ts_latihan_harga'],2); ?></td>
                </tr>
                <tr>
                  <td><strong>Keterangan</strong></td>
                  <td><?php echo $row_list_peserta['ts_latihan_keterangan']; ?></td>
                </tr>
			</table>
		<hr />
		</div>
		  
        <div id="ceramah">
            <h2>Ceramah</h2>
              
            <?php if ($totalRows_list_topic == 0) { // Show if recordset empty ?>
            <p class="msg info">Belum ada ceramah bagi latihan amali ini. Klik pada pautan tambah ceramah di bawah</p>
            <?php } // Show if recordset empty ?>
			<?php if ($totalRows_list_topic > 0) { // Show if recordset not empty ?>
                <table width="100%">
					<thead>
						<tr>
							<th width="15">Bil</th>
							<th>Tajuk Topik</th>
							<th>Penceramah</th>
							<th>Tarikh</th>
							<th>Masa Mula</th>
							<th>Masa Tamat</th>
						</tr>
					</thead>
					<tbody>
                <?php do { ?>
						<tr>
							<td class="t-center"><?php echo ++$orderNum1; ?></td>
							<td>
								<a href="ubah-topik.php?id=<?php echo $row_list_topic['topic_id']; ?>"><?php echo strtoupper($row_list_topic['topic_title']); ?></a>
							</td>
							<td>
								<a href="details-penceramah.php?instruct_id=<?php echo $row_list_topic['instruct_id']; ?>"><?php echo strtoupper($row_list_topic['topic_instructor']); ?></a>
							</td>
							<td class="t-center"><?php echo date("d F Y",strtotime($row_list_topic['topic_date'])); ?></td>
							<td class="t-center"><?php echo $row_list_topic['topic_date_start']; ?></td>
							<td class="t-center"><?php echo $row_list_topic['topic_date_end']; ?></td>
						</tr>
					<?php } while ($row_list_topic = mysql_fetch_assoc($list_topic)); ?>
					</tbody>
				</table>
				<hr />
            <?php } // Show if recordset not empty ?>
		</div>
		
		<div id="honorarium">
            <h2>Honorarium</h2> 
            <?php if ($totalRows_honorarium == 0) { // Show if recordset empty ?>
            <p class="msg info">Belum ada rekod honorarium. Klik pada pautan tambah honorarium di bawah</p>
            <?php } // Show if recordset empty ?>
			<?php if ($totalRows_honorarium > 0) { // Show if recordset not empty ?>
                <table width="100%">
					<thead>
						<tr>
							<th width="15">Bil</th>
							<th>Tajuk Topik</th>
							<th>Penceramah</th>
							<th>Kadar/jam(RM)</th>
							<th>Jumlah jam</th>
							<th>Honorarium (RM)</th>
						</tr>
					</thead>
					<tbody>
                <?php do { ?>
						<tr>
							<td class="t-center"><?php echo ++$orderNum3; ?></td>
							<td>
								<a href="ubah-topik.php?id=<?php echo $row_honorarium['topic_id']; ?>"><?php echo strtoupper($row_honorarium['topic_title']); ?></a>
							</td>
							<td>
								<a href="details-penceramah.php?instruct_id=<?php echo $row_list_topic['instruct_id']; ?>"><?php echo strtoupper($row_honorarium['topic_instructor']); ?></a>
							</td>
							<td class="t-center"><?php echo number_format($row_honorarium['topic_rate'],2); ?></td>
							<td class="t-center"><?php echo $row_honorarium['topic_hour']; ?></td>
							<td class="t-center"><?php echo number_format($row_honorarium['jumlah'],2); ?></td>
						</tr>
					<?php } while ($row_honorarium = mysql_fetch_assoc($honorarium)); ?>
					</tbody>
					<tfoot>
						<tr>
						  <td>&nbsp;</td>
						  <td colspan="3">Jumlah</th>
						  <td class="t-center"><?php echo $row_honorarium_total['total_hour']; ?></td>
						  <td class="t-center"><?php echo number_format($row_honorarium_total['jumlah'],2); ?></td>
						</tr>
					</tfoot>
				</table>
				<hr />
            <?php } // Show if recordset not empty ?>
		</div>
		
		<div id="peserta">
		<h2>Senarai Peserta</h2>
		
        <?php if ($totalRows_peserta == 0) { // Show if recordset empty ?>
		<p class="msg info">Belum ada peserta bagi latihan amali ini. Klik pada pautan tambah peserta diatas bagi memasukkan maklumat peserta secara manual</p>
        <?php } // Show if recordset empty ?>
        <?php if ($totalRows_peserta > 0) { // Show if recordset not empty ?>
		<p class="msg info">Sila klik pada status permohonan bagi menukar status peserta</p>
			<table width="100%">
				<thead>
					<tr>
						<th width="15" class="t-center">Bil</th>
						<th>Nama Penuh</th>
						<th width="100" class="t-center">No IC</th>
						<th width="170" class="t-center">Status Permohonan</th>
						<th width="70" class="t-center">Pengesahan</th>
						<th width="50" class="t-center">Sijil</th>
						<th width="50" class="t-center">Tindakan</th>
						<th width="50" class="t-center">E-mail</th>
					</tr>
				</thead>
				<tbody>
			<?php do { ?>
					<tr>
						<td class="t-center"><?php echo ++$orderNum2; ?></td>
						<td><a href="../user/user-page.php?ts_peserta_ID=<?php echo $row_peserta['ts_peserta_ID']; ?>"><?php echo strtoupper($row_peserta['nama']); ?></a></td>
						<td class="t-center"><?php echo $row_peserta['ic']; ?></td>
						<td class="t-center"><a href="#"><span class="status" id="<?php echo $row_peserta['ts_peserta_ID']; ?>"><?php echo $row_peserta['status']; ?></a></span></td>
						<td class="t-center"><a href="cetak-akuan-pengesahan.php?ts_latihan_id=<?php echo $row_peserta['ts_latihan_id']; ?>&ts_peserta_ID=<?php echo $row_peserta['ts_peserta_ID']; ?>"><img src="img/icons/table.png" alt="Pengesahan"/></a></td>
						<td class="t-center"><a href="cetak-sijil.php?ts_latihan_id=<?php echo $row_peserta['ts_latihan_id']; ?>&ts_peserta_ID=<?php echo $row_peserta['ts_peserta_ID']; ?>"><img src="img/icons/printer.png" alt="Sijil"/></a></td>
						<td class="t-center">
							<a href="padam-peserta.php?peserta_id=<?php echo $row_peserta['ts_peserta_ID']; ?>&kursus_id=<?php echo $row_peserta['ts_latihan_id']; ?>" onClick="javascript: return confirm('Anda pasti ingin memadam rekod peserta ini? \nKlik OK untuk padam. \nKlik CANCEL untuk kembali.');"><img src="img/icons/delete.png" alt="Padam"/></a>
						</td>
						<td class="t-center"><a href="includes/sendmail.php?ts_peserta_ID=<?php echo $row_peserta['ts_peserta_ID']; ?>"><img src="img/icons/email.png" /></a></td>
					</tr>
					<?php } while ($row_peserta = mysql_fetch_assoc($peserta)); ?>
				</tbody>
			</table>
			<br />
		<div class="buttons">
            <a href="print-senarai-peserta.php?id=<?php echo $row_list_peserta['ts_latihan_id']; ?>">
			<img src="img/icons/printer.png" alt=""/>Cetak senarai peserta</a>
		</div>
		<br /><br />
			<hr />
		<?php } // Show if recordset not empty ?>
		</div>
		<div id="pendahuluan">
		<!-- Headings -->
        <h2>Bayaran Pendahuluan</h2>
			<div class="buttons">
				<a href="tambah-bayaran-pendahuluan-kursus.php?id=<?php echo $_GET['ts_latihan_id']; ?>">
				<img src="img/icons/user_suit.png" alt=""/>Tambah Rekod</a>
			</div>
            <div class="fix"></div>
			<?php if ($totalRows_rekod == 0) { // Show if recordset empty ?>
            <p class="msg info">Belum ada maklumat pendahuluan bagi latihan amali ini. Klik pada pautan tambah rekod di bawah</p>
				<?php } // Show if recordset empty ?>
				<?php if ($totalRows_rekod > 0) { // Show if recordset not empty ?>
				<p class="msg info">Berikut adalah senarai pengambil pendahuluan (advance) bagi kursus ini</p>
				<table width="100%">
					<thead>
						<tr>
							<th width="15" height="14">Bil.</th>
							<th>Nama</th>
							<th width="180">Tarikh Mohon</th>
							<th width="180">Tarikh Kembali</th>
							<th width="80" class="t-center">Jumlah (RM)</th>
						</tr>
					</thead>
					<tbody>
				<?php do { ?>
						<tr>
							<td width="15" height="29"><span class="a-center"><?php echo ++$orderNum; ?></span></td>
							<td><?php echo $row_rekod['ts_admin_nama']; ?></td>
							<td width="180"><?php echo date("d F Y",strtotime($row_rekod['ts_advance_tarikh_ambil'])); ?></td>
							<td width="180"><?php echo date("d F Y",strtotime($row_rekod['ts_advance_tarikh_kembali'])); ?></td>
							<td width="80" class="t-right"><?php echo number_format($row_rekod['ts_advance_jumlah'],2); ?></td>
						</tr>
				<?php } while ($row_rekod = mysql_fetch_assoc($rekod)); ?>
					</tbody>
					<tfoot>
						<tr>
							<td height="29" colspan="4">JUMLAH</td>
							<td class="t-right"><?php echo number_format($row_pendahuluan['jumlah'],2); ?></td>
						</tr>
					</tfoot>
				</table>
				<hr />
				<?php } // Show if recordset not empty ?>
			<div class="fix"></div>
		<!-- 3 columns -->
		</div>
		<div class="buttons">
            <a href="ubah-latihan.php?ts_latihan_id=<?php echo $row_list_peserta['ts_latihan_id']; ?>">
			<img src="../ico_edit.gif" alt=""/>Ubah</a>
			
            <a href="padam-latihan.php?id=<?php echo $row_list_peserta['ts_latihan_id']; ?>" onClick="javascript: return confirm('Anda pasti ingin memadam kursus ini? \nKlik OK untuk padam. \nKlik CANCEL untuk kembali.');"><img src="img/icons/cross.png" alt=""/>Padam</a>
			
			<a href="upload-latihan.php?ts_latihan_id=<?php echo $row_list_peserta['ts_latihan_id']; ?>">
			<img src="img/icons/attach.png" alt=""/>Muat-naik</a>
			
			<a href="tambah-topik.php?ts_latihan_id=<?php echo $row_list_peserta['ts_latihan_id']; ?>">
			<img src="img/icons/images.png" alt=""/>Tambah Ceramah</a>
			
			<a href="tambah-penceramah.php?ts_latihan_id=<?php echo $row_list_peserta['ts_latihan_id']; ?>">
            <img src="img/icons/user_suit.png" alt=""/>Tambah Penceramah</a>

            <a href="tambah-peserta.php?ts_latihan_id=<?php echo $row_list_peserta['ts_latihan_id']; ?>">
            <img src="img/icons/group_add.png" alt=""/>Tambah Peserta</a>

            <a href="javascript:history.go(-1)">
            <img src="img/icons/arrow_undo.png" alt=""/>Kembali</a>
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
mysql_free_result($list_peserta);
mysql_free_result($peserta);
mysql_free_result($list_topic);
mysql_free_result($brosur);
?>
