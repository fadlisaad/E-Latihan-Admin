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
      <td>&nbsp;</td>
      <td colspan="3"><img src="break.jpg" /></td>
      <td>&nbsp;</td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3"><img src="break.jpg" /></td>
      <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">PTKL2020/DRAFT/<?php echo $row_as['id']; ?> dlm. DBKL.JPI.200/222/17	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tarikh:<?php echo date("j/m/Y"); ?> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Nama : <?php echo $row_as['first_name']; ?>,<?php echo $row_as['last_name']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Alamat: <?php echo $row_as['address']; ?> <?php echo $row_as['address2']; ?> <?php echo $row_as['city']; ?> <?php echo $row_as['state']; ?> <?php echo $row_as['country']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Poskod: <?php echo $row_as['postal_code']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><img src="break.jpg" align="middle" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Tuan/Puan,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><img src="break.jpg" align="middle" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><strong>JEMPUTAN KE SESI PENDENGARAN BANTAHAN AWAM DRAF PELAN BANDAR RAYA KUALA</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" valign="bottom"><strong>LUMPUR 2020</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" valign="bottom"><img src="break.jpg" align="bottom" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Dengan segala hormatnya saya merujuk kepada perkara diatas.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" valign="bottom"><img src="break.jpg" align="bottom" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">2. Sukacitanya dimaklumkan bahawa Draf Plan Bandar Raya Kuala Lumpur 2020 (DPBRKL 2020) </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">telah dikemukan kepada orang awam untuk mendapatkan pandangan dan bantahan. Ini selaras dengan </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">peruntukan akta seksyen 15 Akta (Perancangan) Wilayah Persekutuan, 1982 (Akta 267), dimana Datuk </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Bandar dengan seberapa segera hendaklah mendengar mereka yang telah membuat permintaan untuk </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">menyampaikan bantahan serta pandangan bertulis.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><img src="break.jpg" align="right" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">3. Dengan ini, tuan/puan dijemput ke Sesi Pendengaran Pandangan Awam DPBRKL2020 yang akan</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">diadakan pada tarikh, masa dan tempat seperti berikut:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="right"><img src="break.jpg" align="right" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="4">&nbsp;</td>
	<td><div align="left"><strong>Tarikh&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $row_as['hearing_date']; ?></strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="370"><div align="left"><strong>Masa&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: <?php echo $row_as['hearing_time']; ?></strong></div></td>
    <td width="404">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="left"><strong>Tempat&nbsp;&nbsp;: <?php echo $row_as['hearing_place']; ?></strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="left"><strong>No. Sesi&nbsp;: Sesi <?php echo $row_as['session_id']; ?></strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
   <td colspan="3" align="right"><img src="break.jpg" align="right" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">4. Bersama ini disertakan <strong>Kod Etika Sesi Pendengaran Pandangan Awam DPBRKL2020 </strong>untuk </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">panduan tuan/puan semasa sesi pendengaran. Sehubungan dengan itu tuan/puan juga diminta untuk</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">mengisi borang pengesahan kehadiran yang disertakan bersama surat ini dan dikembalikan semula kepada </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">pihak Urusetia Pendengaran Awam DPBRKL2020 <strong>seminggu </strong>dari tarikh surat ini dikeluarkan.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="right"><img src="break.jpg" align="right" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">5. Terima kasih diatas sokongan tuan/puan dan semoga segala pandangan yang dikemukakan oleh </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">tuan/puan dapat memandu serta membina Kuala Lumpur ke arah sebuah Bandar Raya Bertaraf Dunia </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">menjelang 2020.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Sekian, terima kasih.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="right"><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="right"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><strong>BERKHIDMAT UNTUK NEGARA</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><strong>BERSEDIA MENYUMBANG, BANDAR RAYA CEMERLANG</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><img src="break.jpg" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><strong>(HAJAH ZAINAB BINTI MOHD. GHAZALI)</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Pengarah,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Jabatan Pelan Induk,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Dewan Bandaraya Kuala Lumpur,</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">b.p. Datuk Bandar Kuala Lumpur.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">Nota:Surat ini disediakan dalam komputer dan tidak perlu ditandatangani.</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>

</html>
<?php
mysql_free_result($as);
?>
