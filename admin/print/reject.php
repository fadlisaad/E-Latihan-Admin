<?php
$colname_as = "-1";
if (isset($_GET['id'])) {
  $colname_as = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_ebantahan, $ebantahan);
$query_as = sprintf("SELECT * FROM public_form WHERE id = %s", $colname_as);
$as = mysql_query($query_as, $ebantahan) or die(mysql_error());
$row_as = mysql_fetch_assoc($as);
$totalRows_as = mysql_num_rows($as);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?php echo $site_title; ?></title>

<!--

Hey friend! This file shows you how 
the CSS Theme you downloaded looks with 
some example HTML form markup.

Check out the README.txt for more info.

-->

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="5%">&nbsp;</td>
      <td width="85%"><img src="break.jpg" /></td>
      <td width="10%">&nbsp;</td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td><img src="break.jpg" /></td>
      <td>&nbsp;</td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td><img src="break.jpg" /></td>
      <td>&nbsp;</td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td><img src="break.jpg" /></td>
      <td>&nbsp;</td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td><img src="break.jpg" /></td>
      <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>PTKL2020/DRAFT/<?php echo $row_as['id']; ?>) dlm. DBKL.JPI.200/222/17	Tarikh:<?php echo date("j/m/Y"); ?> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Nama : <?php echo $row_as['first_name']; ?>,<?php echo $row_as['last_name']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Alamat: <?php echo $row_as['address']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Poskod: </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="break.jpg" align="middle" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Tuan/Puan,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="break.jpg" align="middle" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>KEPUTUSAN JAWATANKUASA PENDENGARAN PANDANGAN AWAM (JKPPA) - DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020 (KL CITY PLAN 2020)</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="bottom"><img src="break.jpg" align="bottom" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Jawatankuasa Pendengaran Pandangan Awam (JKPPA) ingin mengucapkan ribuan terima kasih kepada tuan/puan yang telah sudi mengemukakan pandangan/bantahan melalui borang yang diterima (bertulis/E-Opinion) terhadap Draf Pelan Bandar Raya Kuala Lumpur 2020. </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><img src="break.jpg" align="right" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>2.Sehubungan dengan itu, dimaklumkan bahawa JKPPA menolak pandangan/bantahan tuan/puan. </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	<td valign="bottom"><img src="break.jpg" align="bottom" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>3.Sebarang pertanyaan berhubung perkara di atas, sila hubungi Urus setia Pendengaran Pandangan Awam ( Pn. Siti Hanim (sitihanim@dbkl.gov.my) / Cik Norazmin (norazmin@dbkl.gov.my) di talian 0326179549 / 0326179535/  0326179567 / 032617 9572 atau No. Faks 032986 2150. </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><img src="break.jpg" align="right" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Sekian.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>BERKHIDMAT UNTUK NEGARA</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>BERSEDIA MENYUMBANG, BANDAR RAYA CEMERLANG</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>(HAJAH ZAINAB BINTI MOHD. GHAZALI)</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Pengarah,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Jabatan Pelan Induk,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Dewan Bandaraya Kuala Lumpur,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>b.p. Datuk Bandar Kuala Lumpur.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Nota:Surat ini disediakan dalam komputer dan tidak perlu ditandatangani.</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>

</html>
<?php
mysql_free_result($as);
?>
