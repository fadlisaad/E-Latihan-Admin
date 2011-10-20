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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>e-Opinion for KL City Plan 2020-Borang PA2</title>
<link rel="shorcut icon" href="../favicon.ico" />
<style type="text/css">
<!--
.style3 {font-size: 14px}
.style4 {font-size: 14px; font-weight: bold; }
-->
</style>
</head>

<body>
<p align="right" class="style3">Borang PA 2 </p>
<hr />
<table width="100%" border="0">
  <tr>
    <td width="18%" class="style3"><div align="right"><img src="../images/Draf_DBKL.jpg" alt="draft" width="153" height="93" /></div></td>
    <td class="style3"><p align="center"><strong>BORANG SARINGAN PERTAMA PANDANGAN AWAM DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020</strong></p>    </td>
    <td class="style3"><img src="../images/logo_PA2.jpg" alt="a" width="153" height="49" /></td>
  </tr>
</table>
<br /><hr /><br />
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><strong>BUTIRAN PEMBERI PANDANGAN</strong></td>
  </tr>
</table><br />
<table width="33%" border="1" align="right">
  <tr>
    <td class="style3">No Pandangan</td>
    <td class="style3"><em>PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?></em></td>
  </tr>
  <tr>
    <td class="style3">Tarikh Terima</td>
    <td class="style3"><em><?php echo $row_public_form['date']; ?></em></td>
  </tr>
  <tr>
    <td class="style3">Pegawai Key-in </td>
    <td class="style3"><em>
      <?php 
										  if ($row_public_form['key_in_by'] <> NULL) {
										  		echo $row_public_form['key_in_by']; }
                                          else  echo ' - '; ?>
    </em></td>
  </tr>
  <tr>
    <td class="style3">Jenis Borang</td>
    <td class="style3"><em><?php echo $row_public_form['form_type']; ?></em></td>
  </tr>
</table>


<p></p>

<p class="style3">&nbsp;</p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="205" class="style3">1. Nama *</td>
    <td width="15" class="style3"><strong>:</strong></td>
    <td width="428" class="style3" border="1"><em><?php echo $row_public_form['first_name']; ?>&nbsp;<?php echo $row_public_form['last_name']; ?></em></td>
  </tr>
  <tr>
    <td class="style3">2. No kad pengenalan </td>
    <td width="15" class="style3"><strong>:</strong></td>
    <td class="style3" border="1"><em><?php 		  if ($row_public_form['ic'] <> NULL) {
										  		echo $row_public_form['ic']; }
                                          else  echo ' - '; ?> <?php echo $row_public_form['passport']; ?></em></td>
  </tr>
  <tr>
    <td class="style3">3. Nama agensi </td>
    <td width="15" class="style3"><strong>:</strong></td>
    <td class="style3" border="1"><em><?php 
										  if ($row_public_form['agency_name'] <> NULL) {
										  		echo $row_public_form['agency_name']; }
                                          else  echo ' - '; ?></em></td>
  </tr>
  <tr>
    <td class="style3">4. Kategori </td>
    <td width="15" class="style3"><strong>:</strong></td>
    <td class="style3" border="1"><em><?php 
										  if ($row_public_form['type'] <> NULL) {
										  		echo $row_public_form['type']; }
                                          else  echo ' - '; ?></em></td>
  </tr>
  <tr>
    <td class="style3">5. Alamat surat menyurat  * </td>
    <td width="15" class="style3"><strong>:</strong></td>
    <td class="style3" border="1"><em><?php echo $row_public_form['address1']; ?> <?php echo $row_public_form['address2']; ?></em></td>
  </tr>
  <tr>
    <td class="style3"></td>
    <td width="15" class="style3"></td>
    <td class="style3" border="1"><em><?php 
										  if ($row_public_form['postal_code'] <> NULL) {
										  		echo $row_public_form['postal_code']; }
                                          else  echo ' - '; ?>&nbsp;
	    <?php 
										  if ($row_public_form['city'] <> NULL) {
										  		echo $row_public_form['city']; }
                                          else  echo ' - '; ?></em></td>
  </tr>
  <tr>
    <td class="style3"></td>
    <td width="15" class="style3"></td>
    <td class="style3" border="1"><em><?php echo $row_public_form['state']; ?>&nbsp;<?php echo $row_public_form['country']; ?></em></td>
  </tr>
  <tr>
    <td class="style3">6. No. Telefon  *</td>
    <td width="15" class="style3"><strong>:</strong></td>
    <td class="style3" border="1"><em><?php echo $row_public_form['phone']; ?></em></td>
  </tr>
  <tr>
    <td class="style3">7. No Faksimili</td>
    <td width="15" class="style3"><strong>:</strong></td>
    <td class="style3" border="1"><em><?php 
										  if ($row_public_form['fax'] <> NULL) {
										  		echo $row_public_form['fax']; }
                                          else  echo ' - '; ?></em></td>
  </tr>
  <tr>
    <td class="style3">8. Alamat E-mail</td>
    <td width="15" class="style3"><strong>:</strong></td>
    <td class="style3" border="1"><em><?php 
										  if ($row_public_form['email'] <> NULL) {
										  		echo $row_public_form['email']; }
                                          else  echo ' - '; ?></em></td>
  </tr>
</table>
<br />
<hr />
<br />
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><strong>BUTIRAN PANDANGAN AWAM TERHADAP DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020 (DPBRKL 2020)</strong></td>
  </tr>
</table>
<p class="style4">8. Dengan merujuk Draf Pelan Bandar Raya Kuala Lumpur 2020, sila nyatakan samada muka surat/ no.pelan indeks/ lokasi berkaitan dengan pandangan anda. </p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="132" class="style3"><strong>Jilid Laporan</strong></td>
    <td width="19" class="style3">:</td>
    <td width="497" class="style3" border="1"><em> 
    <?php 
										  if ($row_public_form['cp_page'] <> NULL) {
										  		echo $row_public_form['cp_page']; }
                                          else  echo ' - '; ?></em></td>
  </tr>
  <tr>
    <td width="132" class="style3"><strong>Muka surat</strong></td>
    <td width="19" class="style3">:</td>
    <td width="497" class="style3" border="1"><em> 
    <?php 
										  if ($row_public_form['cp_paragraph'] <> NULL) {
										  		echo $row_public_form['cp_paragraph']; }
                                          else  echo ' - '; ?></em></td>
  </tr>
  <tr>
    <td width="132" class="style3"><strong>No. Pelan Indeks</strong></td>
    <td width="19" class="style3">:</td>
    <td width="497" class="style3" border="1"><em> 
    <?php 
										  if ($row_public_form['cp_table'] <> NULL) {
										  		echo $row_public_form['cp_table']; }
                                          else  echo ' - '; ?></em></td>
  </tr>
  <tr>
    <td width="132" class="style3"><strong>Lokasi</strong></td>
    <td width="19" class="style3">:</td>
    <td width="497" class="style3" border="1"><em>  
    <?php 
										  if ($row_public_form['location'] <> NULL) {
										  		echo $row_public_form['location']; }
                                          else  echo ' - '; ?></em> <em><?php echo $row_public_form['location2']; ?></em></td>
  </tr>
  <tr>
    <td width="132" class="style3"><strong>Zon Strategik</strong></td>
    <td width="19" class="style3">:</td>
   <td width="497" class="style3" border="1"><em>
       <?php if ($totalRows_strategic_zone == 0) {
			echo "-"; }
		  else	
		  	echo $row_strategic_zone['desc']; ?>
    </em></td>
  </tr>
</table>
<span class="style3"><br />
</span>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td class="style4">9. Sila nyatakan dengan jelas pandangan anda dan berikan asas kepada pandangan tersebut.(Gunakan helaian tambahan jika perlu) </td>
  </tr>
  <tr>
    <td class="style3"><em><?php echo $row_public_form['suggestion_desc']; ?></em> </td>
  </tr>
</table>
<span class="style3"><br />
</span>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td class="style4">10. Sila kemukakan pandangan / cadangan bagi menambahbaik Draf Pelan Bandar Raya Kuala Lumpur 2020.
  (Sila lampirkan maklumat tambahan, pelan, gambar dan lain-lain jika perlu)</td>
  </tr>
  <tr>
    <td class="style3"><em>
      <?php if ($row_public_form['propose_object_desc'] <> NULL){
		  echo $row_public_form['propose_object_desc']; }
	  else {
	  	   echo " - "; }
?>
    </em> </td>
  </tr>
</table>

<p class="style3"><strong>11. Rujukan Maklumat<br />
  Volume</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :<em> <?php echo $row_public_form['cp_page']; ?></em><strong><br />
Zon</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :<em>
<?php if ($totalRows_strategic_zone == 0) {
			echo "-"; }
		  else	
		  	echo $row_strategic_zone['desc']; ?>
</em> <br />
</p>
<span class="style3">Sila tandakan (Tema)</span>
<table width="685" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28" class="style3"><img src="box.jpg" width="21" height="20" /></td>
    <td width="301" class="style3"> &nbsp;Bandar Raya Perniagaan Yang Dinamik</td>
    <td width="28" class="style3"><img src="box.jpg" alt="" width="21" height="20" /></td>
    <td width="342" class="style3"> &nbsp;Melindungi dan Mempertingkatkan Alam Sekitar</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="a" width="21" height="20" /></td>
    <td class="style3">&nbsp;Gunatanah Mampan</td>
    <td width="28" class="style3"><img src="box.jpg" alt="a" width="21" height="20" /></td>
    <td class="style3">&nbsp;Mempertingkatkan Lingkaran Hijau dan Koridor Biru</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td class="style3">&nbsp;Perhubungan dan Kemudahsampaian Bandar Raya</td>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td class="style3">&nbsp;Imej dan Identiti Sendiri</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="s" width="21" height="20" /></td>
    <td class="style3">&nbsp;Persekitaran Kehidupan Bandar</td>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td class="style3">&nbsp;Infrastruktur Hijau</td>
  </tr>
</table>

<p class="style3">Sila tandakan (Sektor) </p>
<table width="685" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="a" width="21" height="20" /></td>
    <td width="301" class="style3"> &nbsp;Gunatanah (Landuse) </td>
    <td width="28" class="style3"><img src="box.jpg" alt="a" width="21" height="20" /></td>
    <td width="342" class="style3">&nbsp;EPZ (Environmental Protection Zone)</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="a" width="21" height="20" /></td>
    <td width="301" class="style3"> &nbsp;Kepadatan (Density)</td>
    <td width="28" class="style3"><img src="box.jpg" alt="a" width="21" height="20" /></td>
    <td class="style3">&nbsp;TPZ (Transit Planning Zone)</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td width="301" class="style3">&nbsp;Nisbah Plot (Plot Ratio)</td>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td class="style3">&nbsp;Zon Warisan dan Pengekalan</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="s" width="21" height="20" /></td>
    <td width="301" class="style3">&nbsp;Kawalan Ketinggian (Height Control)</td>
    <td width="28" class="style3">&nbsp;</td>
    <td class="style3">&nbsp;</td>
  </tr>
</table>
<table width="18" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="7" class="style3"></td>
    <td width="11" class="style3"></td>
  </tr>
</table>
<p class="style3">Sila tandakan (Topik) </p>
<table width="685" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td width="305" class="style3"> &nbsp;Sosio Ekonomi</td>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td width="338" class="style3"> &nbsp;Pengangkutan</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="a" width="21" height="20" /></td>
    <td width="305" class="style3"> &nbsp;Guna Tanah</td>
    <td width="28" class="style3"><img src="box.jpg" alt="a" width="21" height="20" /></td>
    <td class="style3"> &nbsp;Perumahan</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td width="305" class="style3"> &nbsp;Perdagangan</td>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td class="style3"> &nbsp;Infrastruktur dan Utiliti</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="s" width="21" height="20" /></td>
    <td width="305" class="style3"> &nbsp;Pelancongan</td>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td class="style3"> &nbsp;Kemudahan Masyarakat</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td width="305" class="style3"> &nbsp;Rekabentuk Bandar dan Landskap</td>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td class="style3"> &nbsp;Persekitaran</td>
  </tr>
  <tr>
    <td width="28" class="style3"><img src="box.jpg" alt="b" width="21" height="20" /></td>
    <td width="305" class="style3"> &nbsp;Kawasan Khusus</td>
    <td width="28" class="style3">&nbsp;</td>
    <td class="style3">&nbsp;</td>
  </tr>
</table>
<table width="307" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="26" class="style3"></td>
    <td width="281" class="style3"></td>
  </tr>
</table>
<span class="style3"><br />
</span>
<table width="498" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="202" class="style3"><strong>12. </strong><span class="style7 style4 style9">Jenis Pandangan</span> : </td>
    <td width="28" class="style3"><img src="box.jpg" width="21" height="20" /></td>
    <td width="69" class="style3">Sokong</td>
    <td width="25" class="style3"><img src="box.jpg" width="21" height="20" /></td>
    <td colspan="4" class="style3">Bantah</td>
    <td width="28" class="style3"><img src="box.jpg" width="21" height="20" /></td>
    <td width="77" colspan="4" class="style3">Cadangan</td>
  </tr>
</table>

<span class="style3"><br />
</span>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="299" class="style4">13. Paparan Makluman Pandangan yang diterima : </td>
    <td width="26" class="style3"><img src="box.jpg" width="21" height="20" /></td>
    <td width="69" class="style3">Ya</td>
    <td width="28" class="style3"><img src="box.jpg" width="21" height="20" /></td>
    <td width="76" colspan="4" class="style3">Tidak</td>
  </tr>
</table>

<p class="style4">14. Ulasan  Berkaitan Aspek Perancangan</p>
<span class="style3"><img src="form.jpg" width="610" height="284" /></span>
<p class="style4">15. Implikasi kepada penerimaan pandangan</p>
<span class="style3"><img src="form.jpg" alt="a" width="610" height="284" /></span>
<p class="style3"><br />
</p>
<hr />
<p class="style3">Nota : Pengesahan</p>
<table width="610" border="0">
  <tr>
    <td class="style3"><strong>Nama Pegawai Kawasan</strong></td>
    <td class="style3">: <?php echo $row_strategic_zone['area_officer']; ?></td>
  </tr>
  <tr>
    <td class="style3"><strong>Maklumat dalam pangkalan data telah dikemaskini</strong></td>
    <td class="style3"> &nbsp;&nbsp;<img src="box.jpg" width="21" height="20" /></td>
  </tr>
  <tr>
    <td class="style3"><strong>Nama Pegawai yang kemas kini</strong></td>
    <td class="style3">:&nbsp; _______________________________________</td>
  </tr>
  <tr>
    <td class="style3"><strong>Tarikh</strong></td>
    <td class="style3">:&nbsp; _______________________________________</td>
  </tr>
</table>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<p class="style3">&nbsp;</p>
<div align="center" class="style3">
  <input type="button" name="button" id="button" value="Print" onclick="window.print()"/>
  <input type="button" name="button2" id="button2" value="Close" onclick="window.close()"/>
</div>
<p class="style3">&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($public_form);

mysql_free_result($strategic_zone);
?>
