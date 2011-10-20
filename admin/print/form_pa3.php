<?php require_once('../Connections/ebantahan.php'); ?>
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

$colname_public_form = "-1";
if (isset($_GET['id'])) {
  $colname_public_form = $_GET['id'];
}
mysql_select_db($database_ebantahan, $ebantahan);
$query_public_form = sprintf("SELECT * FROM public_form WHERE id = %s", GetSQLValueString($colname_public_form, "int"));
$public_form = mysql_query($query_public_form, $ebantahan) or die(mysql_error());
$row_public_form = mysql_fetch_assoc($public_form);
$totalRows_public_form = mysql_num_rows($public_form);

mysql_select_db($database_ebantahan, $ebantahan);
$query_tmn = "SELECT strategic_zone.desc, taman.id_taman, taman.id_SZ, taman.name FROM strategic_zone, taman WHERE taman.id_SZ = strategic_zone.id ORDER BY taman.name ASC";
$tmn = mysql_query($query_tmn, $ebantahan) or die(mysql_error());
$row_tmn = mysql_fetch_assoc($tmn);
$totalRows_tmn = mysql_num_rows($tmn);

$colname_strategic_zone = "-1";
if (isset($_GET['id'])) {
  $colname_strategic_zone = $_GET['id'];
}
mysql_select_db($database_ebantahan, $ebantahan);
$query_strategic_zone = sprintf("SELECT strategic_zone.desc, strategic_zone.area_officer FROM public_form, strategic_zone WHERE strategic_zone.id = public_form.cp_figure and public_form.id = %s", GetSQLValueString($colname_strategic_zone, "int"));
$strategic_zone = mysql_query($query_strategic_zone, $ebantahan) or die(mysql_error());
$row_strategic_zone = mysql_fetch_assoc($strategic_zone);
$totalRows_strategic_zone = mysql_num_rows($strategic_zone);

$colname_session = "-1";
if (isset($_GET['id'])) {
  $colname_session = $_GET['id'];
}
mysql_select_db($database_ebantahan, $ebantahan);
$query_session = sprintf("SELECT public_form.id, public_form.session_id, public_form.hearing_place, public_form.hearing_date, public_form.hearing_time, `session`.chairman, `session`.ajk1, `session`.ajk2 FROM public_form, `session` WHERE public_form.id=%s and `session`.id = public_form.session_id", GetSQLValueString($colname_session, "int"));
$session = mysql_query($query_session, $ebantahan) or die(mysql_error());
$row_session = mysql_fetch_assoc($session);
$totalRows_session = mysql_num_rows($session);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>e-Opinion for KL City Plan 2020-Borang PA3</title>
<link rel="shorcut icon" href="../favicon.ico" />
<style type="text/css">
<!--
.style11 {font-size: 14}
.style12 {font-size: 14; font-weight: bold; }
-->
</style>
</head>

<body>
<hr />

<table width="100%" border="0">
  <tr>
    <td width="18%" class="style11"><div align="right"><img src="../images/Draf_DBKL.jpg" alt="draft" width="153" height="93" /></div></td>
    <td width="66%" class="style11"><p align="center"><strong>BORANG SESI PENDENGARAN PANDANGAN AWAM <br />
DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020</strong><br />
<br />
<strong>(Ahli Panel)</strong>    </p></td>
    <td width="16%" class="style11"><img src="../images/logo_PA3.jpg" alt="s" width="153" height="49" /></td>
  </tr>
</table>

<hr />
<span class="style11"><br />
</span>
<table width="648" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="161" valign="top" class="style11"><strong>No. Pandangan </strong></td>
    <td width="20" valign="top" class="style11"><strong>:</strong></td>
    <td width="500" class="style11 style8"><strong>PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?></strong></td>
  </tr>
  <tr>
    <td width="161" valign="top" class="style11"><strong>No. Sessi</strong></td>
    <td width="20" valign="top" class="style11"><strong>:</strong></td>
    <td width="500" class="style11"><strong><?php echo $row_public_form['session_id']; ?></strong></td>
  </tr>
  <tr>
    <td width="161" valign="top" class="style11"><strong>Tarikh /  Masa</strong></td>
    <td width="20" valign="top" class="style11"><strong>:</strong></td>
    <td width="500" class="style11"><strong> <?php echo $row_public_form['hearing_date']; ?> , <strong><?php echo $row_public_form['hearing_time']; ?></strong></strong></td>
  </tr>
  <tr>
    <td width="161" valign="top" class="style11"><strong>Tempat</strong></td>
    <td width="20" valign="top" class="style11"><strong>:</strong></td>
    <td width="500" class="style11"><strong><?php echo $row_public_form['hearing_place']; ?></strong></td>
  </tr>
  <tr>
    <td width="161" valign="top" class="style11"><strong>Pengerusi</strong></td>
    <td width="20" valign="top" class="style11"><strong>:</strong></td>
    <td width="500" class="style11"><strong><?php echo $row_session['chairman']; ?></strong></td>
  </tr>
  <tr>
    <td width="161" valign="top" class="style11"><strong>Ahli Jawatankuasa</strong></td>
    <td width="20" valign="top" class="style11"><strong>:</strong></td>
    <td width="500" class="style11"><strong>1. <?php echo $row_session['ajk1']; ?></strong></td>
  </tr>
  <tr>
    <td width="161" valign="top" class="style11"><strong>&nbsp;</strong></td>
    <td width="20" valign="top" class="style11"><strong>&nbsp;</strong></td>
    <td width="500" class="style11"><strong>2. <?php echo $row_session['ajk2']; ?></strong></td>
  </tr>
  <tr>
    <td valign="top" class="style11">&nbsp;</td>
    <td valign="top" class="style11">&nbsp;</td>
    <td class="style11"><strong>3. </strong></td>
  </tr>
  <tr>
    <td valign="top" class="style11">&nbsp;</td>
    <td valign="top" class="style11">&nbsp;</td>
    <td class="style11"><strong>4. </strong></td>
  </tr>
  <tr>
    <td valign="top" class="style11">&nbsp;</td>
    <td valign="top" class="style11">&nbsp;</td>
    <td class="style11"><strong>5. </strong></td>
  </tr>
</table>

<span class="style11"><br />
</span>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" class="style11"><strong>BUTIRAN PEMBERI PANDANGAN</strong></td>
  </tr>
</table>
<table width="33%" border="1" align="right">
  <tr>
    <td class="style11">No Pandangan</td>
    <td class="style11"><em>PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?></em></td>
  </tr>
  <tr>
    <td class="style11">Tarikh Terima</td>
    <td class="style11"><em><?php echo $row_public_form['date']; ?></em></td>
  </tr>
  <tr>
    <td class="style11">Jenis Borang</td>
    <td class="style11"><em><?php echo $row_public_form['form_type']; ?></em></td>
  </tr>
</table>
<p class="style11"><br />
</p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="205" class="style11">1. Nama *</td>
    <td width="15" class="style11"><strong>:</strong></td>
    <td width="428" class="style11" border="0"><em><strong><?php echo $row_public_form['first_name']; ?>&nbsp;<?php echo $row_public_form['last_name']; ?></strong></em></td>
  </tr>
  <tr>
    <td class="style11">2. No kad pengenalan </td>
    <td width="15" class="style11"><strong>:</strong></td>
    <td class="style11" border="0"><strong><em>
    <?php 		  if ($row_public_form['ic'] <> NULL) {
										  		echo $row_public_form['ic']; }
                                          else  echo ' - '; ?> <?php echo $row_public_form['passport']; ?></em></strong></td>
  </tr>
  <tr>
    <td class="style11">3. Nama agensi </td>
    <td width="15" class="style11"><strong>:</strong></td>
    <td class="style11" border="0"><strong><em>
    <?php 
										  if ($row_public_form['agency_name'] <> NULL) {
										  		echo $row_public_form['agency_name']; }
                                          else  echo ' - '; ?></em></strong></td>
  </tr>
  <tr>
    <td class="style11">4. Kategori</td>
    <td width="15" class="style11"><strong>:</strong></td>
    <td class="style11" border="0"><em><strong>
    <?php 
										  if ($row_public_form['type'] <> NULL) {
										  		echo $row_public_form['type']; }
                                          else  echo ' - '; ?></strong></em></td>
  </tr>
  <tr>
    <td class="style11">4. Alamat surat menyurat  * </td>
    <td class="style11"><strong>:</strong></td>
    <td class="style11" border="0"><strong><em><?php echo $row_public_form['address1']; ?> <?php echo $row_public_form['address2']; ?></em></strong></td>
  </tr>
  <tr>
    <td class="style11">&nbsp;</td>
    <td class="style11"></td>
    <td class="style11" border="0"><strong><em>
    <?php 
										  if ($row_public_form['postal_code'] <> NULL) {
										  		echo $row_public_form['postal_code']; }
                                          else  echo ' - '; ?>&nbsp;<?php echo $row_public_form['city']; ?></em></strong></td>
  </tr>
  <tr>
    <td class="style11">&nbsp;</td>
    <td class="style11"></td>
    <td class="style11" border="0"><strong><em><?php echo $row_public_form['state']; ?>&nbsp;<?php echo $row_public_form['country']; ?></em></strong></td>
  </tr>
  <tr>
    <td class="style11">5. No. Telefon yang boleh <br />
      dihubungi pada waktu pejabat *</td>
    <td class="style11"><strong>:</strong></td>
    <td class="style11" border="0"><strong><em><?php echo $row_public_form['phone']; ?></em></strong></td>
  </tr>
  <tr>
    <td class="style11">6. No Faksimili.</td>
    <td class="style11"><strong>:</strong></td>
    <td class="style11" border="0"><strong><em>
    <?php 
										  if ($row_public_form['fax'] <> NULL) {
										  		echo $row_public_form['fax']; }
                                          else  echo ' - '; ?></em></strong></td>
  </tr>
  <tr>
    <td class="style11">7. Alamat E-mail</td>
    <td class="style11"><strong>:</strong></td>
    <td class="style11" border="0"><strong><em>
    <?php 
										  if ($row_public_form['email'] <> NULL) {
										  		echo $row_public_form['email']; }
                                          else  echo ' - '; ?></em></strong></td>
  </tr>
</table>

<span class="style11"><br />
</span>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" class="style11"><strong>BUTIRAN PANDANGAN AWAM TERHADAP DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020 (DPBRKL 2020)</strong></td>
  </tr>
</table>

<p class="style11"><strong>8. Dengan merujuk Draf Pelan Bandar Raya Kuala Lumpur 2020, sila nyatakan samada muka surat/ no.pelan indeks/ lokasi berkaitan dengan pandangan anda. </strong></p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="132" class="style11">Jilid Laporan</td>
    <td width="19" class="style11">:</td>
    <td width="497" class="style11" border="0"><em><strong>
      <?php 
										  if ($row_public_form['cp_page'] <> NULL) {
										  		echo $row_public_form['cp_page']; }
                                          else  echo ' - '; ?>
    </strong></em></td>
  </tr>
  <tr>
    <td width="132" class="style11">Muka surat</td>
    <td width="19" class="style11">:</td>
    <td width="497" class="style11" border="0"><strong><em><?php 
										  if ($row_public_form['cp_paragraph'] <> NULL) {
										  		echo $row_public_form['cp_paragraph']; }
                                          else  echo ' - '; ?></em></strong></td>
  </tr>
  <tr>
    <td width="132" class="style11">No. Pelan Indeks</td>
    <td width="19" class="style11">:</td>
    <td width="497" class="style11" border="0"><strong><em><?php 
										  if ($row_public_form['cp_table'] <> NULL) {
										  		echo $row_public_form['cp_table']; }
                                          else  echo ' - '; ?></em></strong></td>
  </tr>
  <tr>
  <td width="132" class="style11">Lokasi</td>
    <td width="19" class="style11">:</td>
    <td width="497" class="style11" border="0"><strong><em> <?php 
										  if ($row_public_form['location'] <> NULL) {
										  		echo $row_public_form['location']; }
                                          else  echo ' - '; ?> <?php 
										  		echo $row_public_form['location2']; ?></em></strong></td>
  </tr>
  <tr>
    <td width="132" class="style11">Zon Strategik</td>
    <td width="19" class="style11">:</td>
    <td width="497" class="style11" border="0"><strong><em>
      <?php if ($totalRows_strategic_zone == 0) {
			echo "-"; }
		  else	
		  	echo $row_strategic_zone['desc']; ?>
    </em></strong></td>
  </tr>
</table>
<p class="style11"><strong>9. Sila nyatakan dengan jelas pandangan anda dan berikan asas kepada pandangan tersebut.<em> (Gunakan helaian tambahan jika perlu)</em></strong></p>
<div class="style11"><em><?php echo $row_public_form['propose_object_desc']; ?></em></div>
<p class="style11"><strong>10. Sila kemukakan pandangan / cadangan bagi menambahbaik Draf Pelan Bandar Raya Kuala Lumpur 2020. <em>(Sila lampirkan maklumat tambahan,  pelan, gambar dan lain-lain jika perlu)</em></strong></p>
<div class="style11"><em><?php echo $row_public_form['suggestion_desc']; ?></em></div>

<p align="right" class="style11"><img src="../images/logo_PA2.jpg" alt="s" width="153" height="49" /></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" class="style11"><strong>MAKLUMAT BERKAITAN IMPLIKASI PENERIMAAN PANDANGAN </strong><em><strong>(Di Isi Oleh Pegawai Kawasan)</strong></em></td>
  </tr>
</table>
<p class="style11"><strong>11. Rujukan  Maklumat</strong></p>
<table border="0" cellspacing="0" cellpadding="0" align="left" width="100%">
  <tr>
    <td width="132" class="style11">Tema</td>
    <td width="19" class="style11">:</td>
    <td width="453" class="style12"><?php echo $row_public_form['theme']; ?></td>
  </tr>
  <tr>
    <td width="132" class="style11">Sektor</td>
    <td width="19" class="style11">:</td>
    <td width="453" class="style11"><strong><?php echo $row_public_form['sector']; ?></strong></td>
  </tr>
  <tr>
    <td class="style11">Topik/perkara</td>
    <td class="style11">:</td>
    <td class="style12"><?php echo $row_public_form['topic']; ?></td>
  </tr>
  <tr>
    <td class="style11">&nbsp;</td>
    <td class="style11">&nbsp;</td>
    <td class="style11">&nbsp;</td>
  </tr>
  <tr>
    <td class="style11">Jenis Pandangan</td>
    <td class="style11">:</td>
    <td class="style11"><strong><?php echo $row_public_form['propose_object']; ?></strong></td>
  </tr>
  <tr>
    <td class="style11">Paparan Makluman Pandangan yang diterima </td>
    <td class="style11">:</td>
    <td class="style11"><strong><?php echo $row_public_form['view']; ?></strong></td>
  </tr>
  <tr>
    <td class="style11">&nbsp;</td>
    <td class="style11">&nbsp;</td>
    <td class="style11">&nbsp;</td>
  </tr>
</table>

<p class="style11"><strong>12. Maklumat Berkaitan</strong> : <br />
  <?php echo $row_public_form['remarks_PA2']; ?></p>
<p class="style11"><strong>13</strong>. <strong>Implikasi kepada penerimaan pandangan : </strong><br />
  <?php echo $row_public_form['implication_PA2']; ?><br />
</p>
<p align="right" class="style11"><br />
<img src="../images/logo_PA3.jpg" alt="s" width="142" height="46" /></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" class="style11"><strong>PENGESYORAN PANDANGAN (<em>Di Isi Oleh Ahli Panel</em> <em>Sesi</em>)</strong></td>
  </tr>
</table>
<p class="style11"><strong>14. Catatan/Ringkasan Pandangan Oleh Ahli Panel Sesi</strong><br />
<img src="form.jpg" alt="a" width="610" height="284" /></p>
<p class="style11"><strong>15. Kategori Pengesyoran Pandangan  Yang Didengar (Sila Tanda  Bagi Yang  Berkenaan) *</strong></p>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="style11"><img src="box.jpg" width="21" height="20" /></td>
    <td class="style11"> &nbsp;&nbsp;1. Berkaitan DPBRKL 2020    </td>
  </tr>
  <tr>
    <td class="style11">&nbsp;</td>
  </tr>
  <tr>
    <td class="style11"></td>
  </tr>
  <tr>
    <td class="style11">&nbsp;</td>
    <td class="style11"> &nbsp;&nbsp;2. Tidak Berkaitan DPBRKL 2020    </td>
  </tr>
  <tr>
    <td class="style11"><img src="box.jpg" width="21" height="20" /></td>
    <td class="style11">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aspek perundangan    </td>
  </tr>
  <tr>
    <td class="style11"><img src="box.jpg" width="21" height="20" /></td>
    <td class="style11">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aspek pengurusan    </td>
  </tr>
  <tr>
    <td class="style11"><img src="box.jpg" width="21" height="20" /></td>
    <td class="style11">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aspek penguatkuasaan    </td>
  </tr>
  <tr>
    <td class="style11"><img src="box.jpg" width="21" height="20" /></td>
    <td class="style11">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aspek pentadbiran    </td>
  </tr>
  <tr>
    <td class="style11"><img src="box.jpg" alt="d" width="21" height="20" /></td>
    <td class="style11">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lain-lain : __________________ </td>
  </tr>
</table>
<p class="style12">16. Pengesyoran Keputusan  (Sila tanda bagi yang berkenaan) dan  nyatakan justifikasi *  </p>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21" >&nbsp;</td>
    <td width="55" class="style11">&nbsp;</td>
    <td width="202" class="style11"><img src="box.jpg" alt="a" width="21" height="20" /> Diterima</td>
    <td width="426" class="style11"><img src="box.jpg" alt="b" width="21" height="20" /> Ditolak</td>
  </tr>
  <tr>
    <td class="style11">&nbsp;</td>
    <td class="style11">&nbsp;</td>
    <td colspan="2" class="style11">Justifikasi : </td>
  </tr>
  <tr>
    <td class="style11"></td>
    <td class="style11"></td>
    <td colspan="2" class="style11"><img src="form.jpg" width="610" height="284" />    </td>
  </tr>
</table>
<span class="style11"><br />
</span>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="style11"><img src="box.jpg" alt="2" width="21" height="20" /></td>
    <td width="34" class="style11"><strong>&nbsp; : </strong></td>
    <td width="350" class="style11">Telah disemak oleh pengerusi panel sesi</td>
  </tr>
</table>
<p class="style11">Disahkan :<br />
</p>
<table width="90%" border="0" align="center">
  <tr>
    <td class="style11"><div align="center">..................................</div></td>
  </tr>
  <tr>
    <td class="style11"><div align="center">T/Tangan Pengerusi Panel Sesi</div></td>
  </tr>
</table>
<p class="style11"><br />
</p>
<table width="90%" border="0" align="center">
  <tr>
    <td class="style11"> <div align="center">..................................</div></td>
    <td class="style11"> <div align="center">..................................</div></td>
    <td class="style11"> <div align="center">..................................</div></td>
    <td class="style11"> <div align="center">..................................</div></td>
  </tr>
  <tr>
    <td class="style11"><div align="center">T/Tangan Ahli Panel 1</div></td>
    <td class="style11"><div align="center">T/Tangan Ahli Panel 2</div></td>
    <td class="style11"><div align="center">T/Tangan Ahli Panel 3</div></td>
    <td class="style11"><div align="center">T/Tangan Ahli Panel 4</div></td>
  </tr>
</table>
<p class="style11">&nbsp;</p>
<hr />
<p class="style11">Nota : Pengesahan</p>
<table width="610" border="0">
  <tr>
    <td class="style11">Nama Pegawai Kawasan</td>
    <td class="style11"> :&nbsp;&nbsp;<?php echo $row_strategic_zone['area_officer']; ?></td>
  </tr>
  <tr>
    <td class="style11">Maklumat dalam pangkalan data telah dikemaskini</td>
    <td class="style11"> :&nbsp;&nbsp;<img src="box.jpg" width="21" height="20" /></td>
  </tr>
  <tr>
    <td class="style11">Nama Pegawai yang kemas kini(uru setia)</td>
    <td class="style11">:&nbsp;&nbsp;_______________________________________</td>
  </tr>
  <tr>
    <td class="style11">Tarikh</td>
    <td class="style11">:&nbsp;&nbsp;_______________________________________</td>
  </tr>
</table>
<p class="style11">&nbsp;</p>
<p class="style11">&nbsp;</p>
<p class="style11">&nbsp;</p>
<p class="style11">&nbsp;</p>
<p class="style11">&nbsp;</p>
<p class="style11">&nbsp;</p>
<p class="style11">&nbsp;</p>
<div align="center" class="style11">
  <input type="button" name="button" id="button" value="Print" onclick="window.print()"/>
  <input type="button" name="button2" id="button2" value="Close" onclick="window.close()"/>
</div>
<p class="style11">&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($public_form);

mysql_free_result($tmn);

mysql_free_result($strategic_zone);

mysql_free_result($session);
?>
