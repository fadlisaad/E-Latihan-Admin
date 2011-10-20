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
$query_strategic_zone = sprintf("SELECT strategic_zone.desc FROM public_form, strategic_zone WHERE strategic_zone.id = public_form.cp_figure and public_form.id = %s", GetSQLValueString($colname_strategic_zone, "int"));
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
<title>Borang PA2 Updated</title>
<style type="text/css">
<!--
.style1 {
	font-size: -1;
	font-style: italic;
}
-->
</style>
</head>

<body>
<p align="right"><strong>Borang PA 2 Lengkap</strong></p>
<hr />
<p align="center"><strong>BORANG SESI PENDENGARAN PANDANGAN AWAM <br />
    DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020</strong></p>
<hr />
<table width="648" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="161" valign="top"><p><strong>No. Pandangan </strong></p></td>
    <td width="20" valign="top"><p><strong>:</strong></p></td>
    <td width="500"><p>PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?></p></td>
  </tr>
  <tr>
    <td width="161" valign="top"><p><strong>No. Sessi</strong></p></td>
    <td width="20" valign="top"><p><strong>:</strong></p></td>
    <td width="500"><p><?php echo $row_public_form['session_id']; ?></p></td>
  </tr>
  <tr>
    <td width="161" valign="top"><p><strong>Tarikh /  Masa</strong></p></td>
    <td width="20" valign="top"><p><strong>:</strong></p></td>
    <td width="500"><p><?php echo $row_public_form['hearing_time']; ?>,<?php echo $row_public_form['hearing_date']; ?></p></td>
  </tr>
  <tr>
    <td width="161" valign="top"><p><strong>Tempat</strong></p></td>
    <td width="20" valign="top"><p><strong>:</strong></p></td>
    <td width="500"><p><?php echo $row_public_form['hearing_time']; ?></p></td>
  </tr>
  <tr>
    <td width="161" valign="top"><p><strong>Pengerusi</strong></p></td>
    <td width="20" valign="top"><p><strong>:</strong></p></td>
    <td width="500"><p><?php echo $row_session['chairman']; ?></p></td>
  </tr>
  <tr>
    <td width="161" valign="top"><p><strong>Ahli Jawatankuasa</strong></p></td>
    <td width="20" valign="top"><p><strong>:</strong></p></td>
    <td width="500"><p>1.<?php echo $row_session['ajk1']; ?></p></td>
  </tr>
  <tr>
    <td width="161" valign="top"><p><strong>&nbsp;</strong></p></td>
    <td width="20" valign="top"><p><strong>&nbsp;</strong></p></td>
    <td width="500"><p>2.<?php echo $row_session['ajk2']; ?></p></td>
  </tr>
</table>

<br />
<table width="680" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><strong>BUTIRAN PEMBERI PANDANGAN</strong></td>
  </tr>
</table>
<br />
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="205">1. Nama *</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td width="428" border="0"><p><em><?php echo $row_public_form['first_name']; ?>&nbsp;<?php echo $row_public_form['last_name']; ?></em></p></td>
  </tr>
  <tr>
    <td>2. No kad pengenalan </td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="0"><p><em><?php echo $row_public_form['ic']; ?> <?php echo $row_public_form['passport']; ?></em></p></td>
  </tr>
  <tr>
    <td>3. Nama agensi </td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="0"><p><em><?php echo $row_public_form['agency_name']; ?></em></p></td>
  </tr>
  <tr>
    <td>4. Alamat surat menyurat  * </td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="0"><p><em><?php echo $row_public_form['address1']; ?>,<?php echo $row_public_form['address2']; ?></em></p></td>
  </tr>
  <tr>
    <td><p>&nbsp;</p></td>
    <td width="15"></td>
    <td border="0"><p><em><?php echo $row_public_form['postal_code']; ?>&nbsp;<?php echo $row_public_form['city']; ?></em></p></td>
  </tr>
  <tr>
    <td><p>&nbsp;</p></td>
    <td width="15"></td>
    <td border="0"><p><em><?php echo $row_public_form['state']; ?>&nbsp;<?php echo $row_public_form['country']; ?></em></p></td>
  </tr>
  <tr>
    <td>5. No. Telefon yang boleh <br />
    dihubungi pada waktu pejabat *</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="0"><p><em><?php echo $row_public_form['phone']; ?></em></p></td>
  </tr>
  <tr>
    <td>6. No Faksimili.</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="0"><p><em><?php echo $row_public_form['fax']; ?></em></p></td>
  </tr>
  <tr>
    <td>7. Alamat E-mail</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="0"><p><em><?php echo $row_public_form['email']; ?></em></p></td>
  </tr>
</table>

<br />
<table width="680" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><strong>BUTIRAN PANDANGAN AWAM TERHADAP DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020</strong></td>
  </tr>
</table>

<p><strong>8. Dengan merujuk Draf Pelan Bandar Raya Kuala Lumpur 2020, sila nyatakan samada muka surat/ no.pelan indeks/ lokasi berkaitan dengan pandangan anda. </strong></p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="132"><p>Jilid Laporan</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="0"><p><em><?php echo $row_public_form['cp_page']; ?></em></p></td>
  </tr>
  <tr>
    <td width="132"><p>Muka surat</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="0"><p><em><?php echo $row_public_form['cp_paragraph']; ?></em></p></td>
  </tr>
  <tr>
    <td width="132"><p>No. Plan Index</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="0"><p><em><?php echo $row_public_form['cp_table']; ?></em></p></td>
  </tr>
  <tr>
  <td width="132"><p>Lokasi</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="0"><p><em> <?php echo $row_public_form['location']; ?></em></p></td>
  </tr>
  <tr>
    <td width="132"><p>Zon Strategik</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="0"><p><em>
      <?php if ($totalRows_strategic_zone == 0) {
			echo "-"; }
		  else	
		  	echo $row_strategic_zone['desc']; ?>
    </em></p></td>
   </tr>
</table>
<p><strong>9. Sila nyatakan dengan jelas pandangan anda dan berikan asas kepada pandangan tersebut.</strong><em>(Gunakan helaian tambahan jika perlu)</em>
<em><?php echo $row_public_form['propose_object_desc']; ?></em></p>
<p><strong>10. Sila kemukakan pandangan / cadangan bagi menambahbaik Draf Pelan Bandar Raya Kuala Lumpur 2020.<br />
  </strong><em>(Sila lampirkan maklumat tambahan,  pelan, gambar dan lain-lain jika perlu)</em><br />
<em><?php echo $row_public_form['suggestion_desc']; ?></em></p>

<p><strong>11. Rujukan  Maklumat</strong></p>
<table border="0" cellspacing="0" cellpadding="0" align="left" width="604">
  <tr>
    <td width="132"><p><strong>Volume</strong></p></td>
    <td width="19"><p>:</p></td>
    <td width="453"><p class="style1"><?php echo $row_public_form['cp_page']; ?></p></td>
  </tr>
  <tr>
    <td width="132"><p><strong>Zon</strong></p></td>
    <td width="19"><p>:</p></td>
    <td width="453"><p><em>
	<?php if ($totalRows_strategic_zone == 0) {
			echo "-"; }
		  else	
		  	echo $row_strategic_zone['desc']; ?></em></p></td>
  </tr>
  <tr>
    <td><strong>Topik/perkara</strong></td>
    <td>:</td>
    <td><em><?php echo $row_public_form['topic']; ?></em></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>12. Kategori Pandangan:</strong></td>
    <td><em><?php echo $row_public_form['propose_object']; ?></em></td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>13. Paparan Makluman Pandangan yang diterima:</strong></td>
    <td><em><?php echo $row_public_form['view']; ?></em></td>

  </tr>
</table>
<p><strong>14. Ulasan  Berkaitan Aspek Perancangan </strong><em>(Diisi oleh pegawai kawasan)</em>
  <br />
<em><?php echo $row_public_form['remarks_PA2']; ?></em></p>
<p><strong>15. Catatan/Ringkasan Pandangan  JKPPA*</strong></p>
<p><strong>16. Pengesyoran Pandangan  Yang Didengar (Sila Tanda  Bagi Yang  Berkenaan) *</strong></p>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><p><img src="box.jpg" width="21" height="20" /></p></td>
    <td>1. Berkaitan DPBRKL 2020    </td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><p><img src="break.jpg" /></p>      </td>
  </tr>
  <tr>
    <td><p>&nbsp;</p></td>
    <td>2. Tidak Berkaitan DPBRKL 2020    </td>
  </tr>
  <tr>
    <td><p><img src="box.jpg" width="21" height="20" /></p></td>
    <td><blockquote>
      &nbsp;&nbsp;&nbsp;&nbsp;aspek perundangan
    </blockquote></td>
  </tr>
  <tr>
    <td><p><img src="box.jpg" width="21" height="20" /></p></td>
    <td><blockquote>
      &nbsp;&nbsp;&nbsp;&nbsp;aspek pengurusan
    </blockquote></td>
  </tr>
  <tr>
    <td><p><img src="box.jpg" width="21" height="20" /></p></td>
    <td><blockquote>
      &nbsp;&nbsp;&nbsp;&nbsp;aspek penguatkuasaan
    </blockquote></td>
  </tr>
  <tr>
    <td><p><img src="box.jpg" width="21" height="20" /></p></td>
    <td><blockquote>
      &nbsp;&nbsp;&nbsp;&nbsp;aspek pentadbiran
    </blockquote></td>
  </tr>
</table>
<p><strong>17. Pengesyoran Keputusan  (Sila tanda bagi yang berkenaan) dan  nyatakan justifikasi *</strong>  </p>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><p><img src="box.jpg" width="21" height="20" /></p></td>
    <td><p><strong> Diterima </strong></p></td>
    <td width="350"><p><br />
    </p></td>
  </tr>
  <tr>
    <td><p>&nbsp;</p></td>
    <td><p>&nbsp;</p></td>
    <td width="350"><p> Justifikasi :</p></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td width="350"><p><img src="form.jpg" width="610" height="284" /></p>    </td>
  </tr>
  <tr>
    <td><img src="box.jpg" alt="box" width="21" height="20" /></td>
    <td><strong> Ditolak</strong></td>
    <td width="350"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td width="350"><p> Justifikasi :</p></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td width="350"><p><img src="form.jpg" alt="" width="610" height="284" /></p></td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><p><img src="box.jpg" alt="2" width="21" height="20" /></p></td>
    <td width="34"><p><strong>:</strong></p></td>
    <td width="350"><p><strong>Perlu dibawa ke Mesyuarat Jawatankuasa Penuh </strong></p></td>
  </tr>
</table>
<p>Disahkan:</p>
<table width="90%" border="0">
  <tr>
    <td>.........................................................</td>
    <td>.........................................................</td>
    <td>.........................................................</td>
  </tr>
  <tr>
    <td><div align="center">T/Tangan  Pengerusi</div></td>
    <td><div align="center">T/Tangan  AJK 1</div></td>
    <td><div align="center">T/Tangan  AJK 2 </div></td>
  </tr>
</table>
<p>* perlu diisi oleh ahli JKPPA yang  bertugas</p>
<hr />
<p>Nota : Pengesahan</p>
<table width="610" border="0">
  <tr>
    <td>Nama Pegawai kawasan</td>
    <td>:_______________________________________</td>
  </tr>
  <tr>
    <td>Maklumat dalam database telah dikemaskini</td>
    <td> <img src="box.jpg" width="21" height="20" /></td>
  </tr>
  <tr>
    <td>Nama Pegawai yang kemas kini</td>
    <td>:_______________________________________</td>
  </tr>
  <tr>
    <td>Tarikh</td>
    <td>:_______________________________________</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($public_form);

mysql_free_result($tmn);

mysql_free_result($strategic_zone);

mysql_free_result($session);
?>
