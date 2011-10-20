<?php require_once('auth.php'); ?>
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

$colname_user_login = "-1";
if (isset($_GET['ts_peserta_ic'])) {
  $colname_user_login = $_GET['ts_peserta_ic'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_user_login = sprintf("SELECT ts_invoice.*, ts_kursus.*, ts_peserta.ts_peserta_ic, ts_peserta.ts_peserta_ID FROM ts_peserta, ts_invoice, ts_kursus WHERE ts_peserta.ts_peserta_ic = %s AND ts_invoice.peserta_id = ts_peserta.ts_peserta_ID AND ts_invoice.kursus_id=ts_kursus.ts_kursus_id", GetSQLValueString($colname_user_login, "text"));
$user_login = mysql_query($query_user_login, $ts_kursus) or die(mysql_error());
$row_user_login = mysql_fetch_assoc($user_login);
$totalRows_user_login = mysql_num_rows($user_login);

$colname_user_details = "-1";
if (isset($_GET['ts_peserta_ic'])) {
  $colname_user_details = $_GET['ts_peserta_ic'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_user_details = sprintf("SELECT * FROM ts_peserta WHERE ts_peserta.ts_peserta_ic=%s", GetSQLValueString($colname_user_details, "text"));
$user_details = mysql_query($query_user_details, $ts_kursus) or die(mysql_error());
$row_user_details = mysql_fetch_assoc($user_details);
$totalRows_user_details = mysql_num_rows($user_details);

isset($startRow_user_login)? $orderNum4=$startRow_user_login:$orderNum4=0;
?>
<?php
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_pertanian = "SELECT * FROM ts_kursus WHERE ts_kursus_kategori = 'Teknologi Tanaman' AND ts_kursus_publish_status = '1' AND ts_kursus_vendor = 'Kursus Luar Jadual' ORDER BY ts_kursus_tarikh_mula DESC";
$pertanian = mysql_query($query_pertanian, $ts_kursus) or die(mysql_error());
$row_pertanian = mysql_fetch_assoc($pertanian);
$totalRows_pertanian = mysql_num_rows($pertanian);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_teknologi_makanan = "SELECT * FROM ts_kursus WHERE ts_kursus_kategori = 'Teknologi Makanan' AND ts_kursus_publish_status = '1' AND ts_kursus_vendor = 'Kursus Luar Jadual' ORDER BY ts_kursus_tarikh_mula DESC";
$teknologi_makanan = mysql_query($query_teknologi_makanan, $ts_kursus) or die(mysql_error());
$row_teknologi_makanan = mysql_fetch_assoc($teknologi_makanan);
$totalRows_teknologi_makanan = mysql_num_rows($teknologi_makanan);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_proses = "SELECT * FROM ts_kursus WHERE ts_kursus_kategori = 'Teknologi Lanjutan' AND ts_kursus_publish_status = '1' AND ts_kursus_vendor = 'Kursus Luar Jadual' ORDER BY ts_kursus_tarikh_mula DESC";
$proses = mysql_query($query_proses, $ts_kursus) or die(mysql_error());
$row_proses = mysql_fetch_assoc($proses);
$totalRows_proses = mysql_num_rows($proses);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_penternakan = "SELECT * FROM ts_kursus WHERE ts_kursus_kategori = 'Teknologi Ternakan' AND ts_kursus_publish_status = '1' AND ts_kursus_vendor = 'Kursus Luar Jadual' ORDER BY ts_kursus_tarikh_mula DESC";
$penternakan = mysql_query($query_penternakan, $ts_kursus) or die(mysql_error());
$row_penternakan = mysql_fetch_assoc($penternakan);
$totalRows_penternakan = mysql_num_rows($penternakan);

isset($startRow_pertanian)? $orderNum=$startRow_pertanian:$orderNum=0;
isset($startRow_teknologi_makanan)? $orderNum2=$startRow_teknologi_makanan:$orderNum2=0;
isset($startRow_proses)? $orderNum3=$startRow_proses:$orderNum3=0;
isset($startRow_penternakan)? $orderNum1=$startRow_penternakan:$orderNum1=0;

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
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/1col.css" title="1col" />
<!-- DEFAULT: 2 COLUMNS -->
<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../css/2col.css" title="2col" />
<!-- ALTERNATE: 1 COLUMN -->
<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]-->
<!-- MSIE6 -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/style.css" />
<!-- GRAPHIC THEME -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/mystyle.css" />
<!-- WRITE YOUR CSS CODE HERE -->
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

<title>Senarai Kursus Luar jadual</title>
</head>
<body>

<div id="main">
	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="../design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="../design/switcher-2col.gif" alt="2 Columns" /></a></span>

			E-Latihan: <strong>Halaman Pengguna</strong></p>

	  <p class="f-right"><?php echo ucwords($_SESSION['SESS_FULLNAME']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="logout.php" id="logout">Log keluar</a></strong></p>
  </div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	
	<div id="menu" class="box">
	  <ul class="box">
        <li><a href="user.php?ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><span>Halaman Utama</span></a></li>
        
        <li><a href="user-edit.php?ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><span>Ubah Biodata</span></a></li>
		<li><a href="logout.php"><span>Log Keluar</span></a></li>
        
        <li><a href="kursus_luar_jadual.php?ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><span>Kursus Luar Jadual</span></a></li>
        <li><a href="kursus_senarai.php?ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><span>Kursus Berjadual</span></a></li>
      </ul>
    </div>
	
	<!-- /header -->

<hr class="noscreen" />

	<!-- Columns -->
  <div id="cols" class="box">

		<!-- Aside (Left Column) -->
	<!-- /aside -->

  <hr class="noscreen" />

	  <!-- Content (Right Column) -->   
 <div class="fix"></div>
    <div id="content">
    <h3>Senarai Kursus Luar Jadual sepanjang tahun 2010</h3>
      <div class="tabs box">
            <ul>
              <li><a href="#tab01"><span>Teknologi Tanaman</span></a></li>
              <li><a href="#tab02"><span>Teknologi Ternakan</span></a></li>
              <li><a href="#tab03"><span>Teknologi Makanan</span></a></li>
              <li><a href="#tab04"><span>Teknologi Lanjutan</span></a></li>
            </ul>
      </div>
      <div id="tab01">
      <h3>Teknologi Tanaman</h3>
		<?php if ($totalRows_pertanian == 0) { // Show if recordset empty ?>
  		<p class="message"><span class="icon">&nbsp;</span>Tiada Kursus ditawarkan</p>
		<?php } // Show if recordset empty ?>
        <?php if ($totalRows_pertanian > 0) { // Show if recordset not empty ?>
          <p>
          <table width="100%">
            <thead>
              <tr>
                <th width="20">Bil</th>
                  <th>Tajuk</th>
                  <th width="60">Yuran</th>
                  <th width="60">Tempat</th>
                  <th width="20">Mohon</th>
                </tr>
            </thead>
            <tbody>
              <?php do { ?>
                <tr valign="top">
                  <td width="20"><?php echo ++$orderNum; ?></td>
                    <td><?php echo strtoupper($row_pertanian['ts_kursus_nama']); ?></td>
                    <td width="60">RM <?php echo $row_pertanian['ts_kursus_harga']; ?></td>
                    <td width="60"><?php echo $row_pertanian['ts_kursus_lokasi']; ?></td>
                    <td width="20"><div align="center"><a href="user-daftar.php?ts_kursus_id=<?php echo $row_pertanian['ts_kursus_id']; ?>&ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><img src="../admin/img/icons/accept.png" alt="Pohon"></a></div></td>
                  </tr>
                <?php } while ($row_pertanian = mysql_fetch_assoc($pertanian)); ?>
            </tbody>
          </table>
        </p><?php } // Show if recordset not empty ?>
      </div>
      <div id="tab02">
      <h3>Teknologi Ternakan</h3>
<?php if ($totalRows_penternakan == 0) { // Show if recordset empty ?>
  <p class="message"><span class="icon">&nbsp;</span>Tiada Kursus ditawarkan</p>
<?php } // Show if recordset empty ?>

<?php if ($totalRows_penternakan > 0) { // Show if recordset not empty ?>
  <p><table width="100%">
    <thead>
      <tr>
        <th width="20">Bil</th>
          <th>Tajuk</th>
          <th width="60">Yuran</th>
          <th width="60">Tempat</th>
          <th width="20">Mohon</th>
        </tr>
      </thead>
    <tbody>
      <?php do { ?>
        <tr valign="top">
          <td width="20"><?php echo ++$orderNum1; ?></td>
          <td><?php echo strtoupper($row_penternakan['ts_kursus_nama']); ?></td>
          <td width="60">RM <?php echo $row_penternakan['ts_kursus_harga']; ?></td>
          <td width="60"><?php echo $row_penternakan['ts_kursus_lokasi']; ?></td>
          <td width="20"><div align="center"><a href="user-daftar.php?ts_kursus_id=<?php echo $row_penternakan['ts_kursus_id']; ?>&ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><img src="../admin/img/icons/accept.png" alt="Pohon"></a></div></td>
        </tr>
        <?php } while ($row_penternakan = mysql_fetch_assoc($penternakan)); ?>
      </tbody>
  </table>
  </p>
  <?php } // Show if recordset not empty ?>
</div>
      <div id="tab03">
      <h3>Teknologi Makanan</h3>
  <?php if ($totalRows_teknologi_makanan == 0) { // Show if recordset empty ?>
    <p class="message"><span class="icon">&nbsp;</span>Tiada Kursus ditawarkan</p>
  <?php } // Show if recordset empty ?>
  <?php if ($totalRows_teknologi_makanan > 0) { // Show if recordset not empty ?>
    <p><table width="100%">
      <thead>
        <tr>
          <th width="20">Bil</th>
              <th>Tajuk</th>
              <th width="60">Yuran</th>
              <th width="60">Tempat</th>
              <th width="20">Mohon</th>
            </tr>
        </thead>
      <tbody>
        <?php do { ?>
          <tr valign="top">
            <td width="20"><?php echo ++$orderNum2; ?></td>
              <td><?php echo strtoupper($row_teknologi_makanan['ts_kursus_nama']); ?></td>
              <td width="60">RM <?php echo $row_teknologi_makanan['ts_kursus_harga']; ?></td>
              <td width="60"><?php echo $row_teknologi_makanan['ts_kursus_lokasi']; ?></td>
              <td width="20"><div align="center"><a href="user-daftar.php?ts_kursus_id=<?php echo $row_teknologi_makanan['ts_kursus_id']; ?>&ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><img src="../admin/img/icons/accept.png" alt="Pohon"></a></div></td>
            </tr>
          <?php } while ($row_teknologi_makanan = mysql_fetch_assoc($teknologi_makanan)); ?>
        </tbody>
      </table>
  </p><?php } // Show if recordset not empty ?>
      </div>
      <div id="tab04">
      <h3>Teknologi Lanjutan</h3>
  <?php if ($totalRows_proses == 0) { // Show if recordset empty ?>
    <p class="message"><span class="icon">&nbsp;</span>Tiada Kursus ditawarkan</p>
  <?php } // Show if recordset empty ?>
  <?php if ($totalRows_proses > 0) { // Show if recordset not empty ?>
    <p><table width="100%">
      <thead>
        <tr>
          <th width="20">Bil</th>
              <th>Tajuk</th>
              <th width="60">Yuran</th>
              <th width="60">Tempat</th>
              <th width="20">Mohon</th>
            </tr>
        </thead>
      <tbody>
        <?php do { ?>
          <tr valign="top">
            <td width="20"><?php echo ++$orderNum3; ?></td>
              <td><?php echo strtoupper($row_proses['ts_kursus_nama']); ?></td>
              <td width="60">RM <?php echo $row_proses['ts_kursus_harga']; ?></td>
              <td width="60"><?php echo $row_proses['ts_kursus_lokasi']; ?></td>
              <td width="20"><div align="center"><a href="user-daftar.php?ts_kursus_id=<?php echo $row_proses['ts_kursus_id']; ?>&ts_peserta_ic=<?php echo $row_user_details['ts_peserta_ic']; ?>"><img src="../admin/img/icons/accept.png" alt="Pohon"></a></div></td>
            </tr>
          <?php } while ($row_proses = mysql_fetch_assoc($proses)); ?>
        </tbody>
      </table>
  </p><?php } // Show if recordset not empty ?>
      </div>
      <!-- /tab closed -->	
    </div>
	<!-- /content -->

	<hr class="noscreen" />

	<!-- Footer -->
	
	<div id="footer" class="box">
      <p class="f-left"><span class="t-left">&copy; 2010 Hakcipta Terpelihara E-Latihan</span></p>
      <p class="f-right"><span class="t-left">Program Kursus dan Latihan Teknikal, Pusat Perkhidmatan Teknikal, MARDI</span></p>
	  </div>
  
	<!-- /footer -->
</div> 
<!-- /main -->
</div>
</body>
</html>
<?php
mysql_free_result($user_login);
mysql_free_result($user_details);
mysql_free_result($pertanian);
mysql_free_result($teknologi_makanan);
mysql_free_result($proses);
mysql_free_result($penternakan);
?>