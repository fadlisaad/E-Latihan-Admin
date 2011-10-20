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

isset($startRow_user_login)? $orderNum=$startRow_user_login:$orderNum=0;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_padam = "SELECT id FROM ts_pictures, ts_peserta WHERE ts_peserta.ts_peserta_ID=ts_pictures.files_id";
$padam = mysql_query($query_padam, $ts_kursus) or die(mysql_error());
$row_padam = mysql_fetch_assoc($padam);
$totalRows_padam = mysql_num_rows($padam);
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
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<title>Halaman Pengguna</title>
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
    <h3>Selamat datang, <?php echo ucwords($_SESSION['SESS_FULLNAME']);?></h3>
	  <p>Berikut adalah maklumat berkenaan pendaftaran anda dalam kursus-kursus yang ditawarkan oleh Program Kursus dan Latihan Teknikal. Jika terdapat sebarang perubahan terhadap maklumat anda seperti pertukaran alamat atau nombor telefon, anda boleh mengubah maklumat tersebut disini. Status permohonan anda hanya akan dianggap tidak berjaya sekiranya anda tidak mendapat sebarang maklumbalas dari pihak urusetia dalam tempoh 2 minggu dari tarikh permohonan atau sebelum tarikh tutup pendaftaran.
      </p>
      <div class="tabs box">
            <ul>
              <li><a href="#tab01"><span>Status Permohonan</span></a></li>
<li><a href="#tab03"><span>Biodata</span></a></li>
</ul>
      </div>
          
      
        <div id="tab01">
          <?php if ($totalRows_user_login == 0) { // Show if recordset empty ?>
          <p class="msg info">Tiada maklumat pendaftaran kursus</p>
          <?php } // Show if recordset empty ?>
          <?php if ($totalRows_user_login > 0) { // Show if recordset not empty ?>
          <h4>Berikut adalah senarai permohonan kursus anda</h4>
          <table width="100%">
            <tr>
              <th width="200">No. Pesanan</th>
              <th>Tajuk Kursus</th>
              <th>Tarikh</th>
              <th>Yuran</th>
              <th>Status</th>
              <th>Pembatalan</th>
            </tr>
            <?php do { ?>
              <tr>
                <td width="200"><?php echo $row_user_login['invoices']; ?></td>
                <td><?php echo $row_user_login['ts_kursus_nama']; ?></td>
                <td><?php if ($row_user_login['ts_kursus_tarikh_mula']=='0000-00-00'){
					echo 'Akan ditentukan'; 
				}
				else { 
					echo date("d/m/Y",strtotime($row_user_login['ts_kursus_tarikh_mula'])); ?>
                - <?php echo date("d/m/Y",strtotime($row_user_login['ts_kursus_tarikh_tamat']));
					}
				?></td>
                <td>RM <?php echo $row_user_login['ts_kursus_harga']; ?></td>
                <td><?php if($row_user_login['active'] == 0)
				echo "Sedang diproses";
				else echo "Layak"; ?></td>
                <td class="t-center"><a href="padam-kursus.php?ts_kursus_id=<?php echo $row_user_login['ts_kursus_id']; ?>" onClick="javascript: return confirm('Adakah anda pasti ingin membatalkan penyertaan anda? \nKlik OK untuk membatalkan penyertaan anda. \nKlik CANCEL untuk kembali ke halaman utama.');"><img src="../admin/img/icons/delete.png" alt="Batalkan" width="16" height="16" /></a></td>
              </tr>
              <?php } while ($row_user_login = mysql_fetch_assoc($user_login)); ?>
          </table>
		  <?php } // Show if recordset not empty ?>
      </div>
        
<div id="tab03">
<div class="col50 f-right">
              <fieldset>
              <legend>Gambar</legend>
              <table width="100%" class="nostyle">
                <tr>
                  <td><a href="../view-files.php?id=<?php echo $row_user_details['ts_peserta_ID']; ?>"><img src="../view-files.php?id=<?php echo $row_user_details['ts_peserta_ID']; ?>" alt="-Tiada gambar-" width="200" /></a></td>
                </tr>
                <tr>
                  <td><div class="buttons"><a href="padam-upload.php?id=<?php echo $row_padam['id']; ?>&ts_peserta_ID=<?php echo $row_user_details['ts_peserta_ID']; ?>" onClick="javascript: return confirm('Adakah anda pasti ingin memadam gambar anda? \nKlik OK untuk padam gambar anda. \nKlik CANCEL untuk kembali ke halaman utama.');"><img src="../admin/img/icons/delete.png" width="16" height="16" title="Padam fail" />Padam gambar</a></div>
                  <div class="buttons">
              <a href="#" onclick="MM_openBrWindow('../user/upload.php?ts_peserta_ID=<?php echo $row_user_details['ts_peserta_ID'] ?>','Upload','width=300,height=200')">
              <img src="../admin/img/icons/disk.png" alt=""/>Muat-naik gambar</a></div></td>
                </tr>
                <tr>
                  <td></td>
                </tr>
              </table></p>
              </fieldset>
              </div>
  <div class="col50">
  <fieldset> 
    <legend>Maklumat Peribadi</legend>
      <table width="100%" class="nostyle">
      <tr>
        <td width="150">Nama Penuh</td>
        <td><?php echo strtoupper($row_user_details['ts_peserta_nama']); ?></td>
      </tr>
      <tr>
        <td width="150">No. IC/Passport</td>
        <td><?php echo $row_user_details['ts_peserta_ic']; ?></td>
      </tr>
      <tr>
        <td width="150">Jantina</td>
        <td><?php echo strtoupper($row_user_details['ts_peserta_jantina']); ?></td>
      </tr>
      <tr>
        <td width="150">Umur</td>
        <td><?php echo $row_user_details['ts_peserta_umur']; ?></td>
      </tr>
    </table>
  </fieldset>

  <fieldset> 
    <legend>Maklumat Untuk Dihubungi</legend>
    <table width="100%" class="nostyle">
      <tr>
        <td width="150">No. Telefon Bimbit</td>
        <td><?php echo $row_user_details['ts_peserta_handfone']; ?></td>
      </tr>
      <tr>
        <td width="150">No.Telefon Rumah</td>
        <td><?php echo $row_user_details['ts_peserta_homeline']; ?></td>
      </tr>
      <tr>
        <td width="150"><label for="label">Alamat Rumah</label></td>
        <td><?php echo strtoupper($row_user_details['ts_peserta_alamat']); ?></td>
      </tr>
      <tr>
        <td width="150"><label for="label">E-mail</label></td>
        <td><?php echo $row_user_details['ts_peserta_email']; ?></td>
      </tr>
    </table>
      </fieldset>

      <fieldset> 
        <legend>Maklumat Lain</legend>
        <table width="100%" class="nostyle">
  <tr>
    <td width="150"><label>Taraf Perkahwinan</label></td>
    <td><?php echo strtoupper($row_user_details['ts_peserta_perkahwinan']); ?></td>
  </tr>
  <tr>
    <td width="150">Pendidikan</td>
    <td><?php echo strtoupper($row_user_details['ts_peserta_pendidikan']); ?></td>
  </tr>
  <tr>
    <td width="150"><label>Pekerjaan</label></td>
    <td><?php echo strtoupper($row_user_details['ts_peserta_pekerjaan']); ?></td>
  </tr>
  <tr>
    <td width="150">Bidang</td>
    <td><?php echo strtoupper($row_user_details['ts_peserta_perusahaan']); ?></td>
  </tr>
</table>
</fieldset>

  <fieldset> 
    <legend>Maklumat Majikan</legend>
    <table width="100%" class="nostyle">
  <tr>
    <td width="150"><label>Majikan</label></td>
    <td><?php echo strtoupper($row_user_details['ts_majikan_nama']); ?></td>
  </tr>
  <tr>
    <td width="150"><label>Alamat</label></td>
    <td><?php echo strtoupper($row_user_details['ts_majikan_alamat']); ?></td>
  </tr>
  <tr>
    <td width="150"><label>No. Telefon</label></td>
    <td><?php echo $row_user_details['ts_majikan_telefon']; ?></td>
  </tr>
</table>
</fieldset>
</div>
<div class="fix"></div>
<p>Sila pastikan segala maklumat yang telah dimasukkan adalah tepat. Klik 'Log Keluar' untuk keluar dari halaman ini.</p>
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

mysql_free_result($padam);
?>