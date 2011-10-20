<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_ts_kursus = "localhost";
$database_ts_kursus = "data_ts";
$username_ts_kursus = "root";
$password_ts_kursus = "nazira";
$ts_kursus = mysql_pconnect($hostname_ts_kursus, $username_ts_kursus, $password_ts_kursus) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
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

$colname_pengeluaran = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_pengeluaran = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_pengeluaran = sprintf("SELECT ts_kursus_id, ts_kursus_nama, ts_kursus_kod, ts_kursus_kategori, ts_kursus_tarikh_mula, ts_kursus_tarikh_tamat FROM ts_kursus WHERE ts_kursus_id = %s", GetSQLValueString($colname_pengeluaran, "int"));
$pengeluaran = mysql_query($query_pengeluaran, $ts_kursus) or die(mysql_error());
$row_pengeluaran = mysql_fetch_assoc($pengeluaran);
$totalRows_pengeluaran = mysql_num_rows($pengeluaran);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="STYLESHEET" href="print_static.css" type="text/css" />
</head>

<body>

<div id="body">

<div id="section_header">BORANG ARAHAN PENGELUARAN BIL KURSUS
</div>

<div id="content">
  
<div class="page" style="font-size: 10pt">

<table style="width: 100%; font-size: 10pt;">
<tr>
<td width="23%">TAJUK KURSUS/PROGRAM<strong></strong></td>
<td width="77%"><?php echo $row_pengeluaran['ts_kursus_nama']; ?></td>
</tr>

<tr>
<td>KOD/JENIS KURSUS<strong></strong></td>
<td><?php echo $row_pengeluaran['ts_kursus_kod']; ?> / <?php echo $row_pengeluaran['ts_kursus_kategori']; ?></td>
</tr>

<tr>
<td>TARIKH KURSUS<strong></strong></td>
<td><?php echo $row_pengeluaran['ts_kursus_tarikh_mula']; ?> hingga <?php echo $row_pengeluaran['ts_kursus_tarikh_tamat']; ?></td>
</tr>
</table>

<table class="change_order_items">
<tbody>
<tr>
<th width="3%">BIL</th>
<th width="26%">NAMA DAN ALAMAT PENERIMA BIL</th>
<th width="19%">NAMA PESERTA</th>
<th width="20%">NO. PESANAN TEMPATAN / RUJUKAN</th>
<th width="6%">JUMLAH</th>
<th width="26%">(UNTUK KEGUNAAN PEJABAT TWP)<br>
  NO.BIL &amp; CATATAN</th>
</tr>

<tr class="even_row">
<td style="text-align: center">1</td>
<td>&nbsp;</td>
<td style="text-align: center">SEPERTI BERLAMPIR</td>
<td style="text-align: right; border-right-style: none;">&nbsp;</td>
<td class="change_order_total_col">RM</td>
<td class="change_order_total_col">&nbsp;</td>
</tr>
<tr class="even_row">
  <td style="text-align: center">&nbsp;</td>
  <td><strong>JUMLAH BESAR</strong></td>
  <td style="text-align: center">&nbsp;</td>
  <td style="text-align: right; border-right-style: none;">&nbsp;</td>
  <td class="change_order_total_col">&nbsp;</td>
  <td class="change_order_total_col">&nbsp;</td>
</tr>
</tbody>
</table>
<table class="odd_row">
  <tbody>
    <tr>
      <td width="3%">Disediakan oleh:</td>
      <td width="26%">&nbsp;</td>
      <td width="19%">Disahkan oleh:</td>
      <td width="20%">&nbsp;</td>
      <td width="6%">Diterima oleh:</td>
      <td width="26%">&nbsp;</td>
    </tr>
    <tr>
      <td>Tandatangan</td>
      <td>&nbsp;</td>
      <td>Tandatangan</td>
      <td>&nbsp;</td>
      <td>Tandatangan</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>&nbsp;</td>
      <td>Nama</td>
      <td>&nbsp;</td>
      <td>Nama</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Tarikh</td>
      <td>&nbsp;</td>
      <td>Tarikh</td>
      <td>&nbsp;</td>
      <td>Tarikh</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>

<script type="text/php">

if ( isset($pdf) ) {

  $font = Font_Metrics::get_font("arial");;
  $size = 6;
  $color = array(0,0,0);
  $text_height = Font_Metrics::get_font_height($font, $size);

  $foot = $pdf->open_object();
  
  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - 2 * $text_height - 24;
  $pdf->line(16, $y, $w - 16, $y, $color, 1);

  $y += $text_height;

  $text = "Fail:";
  $pdf->text(16, $y, $text, $font, $size, $color);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

  global $initials;
  $initials = $pdf->open_object();
  
  // Add an initals box
  $text = "Initials:";
  $width = Font_Metrics::get_text_width($text, $font, $size);
  $pdf->text($w - 16 - $width - 38, $y, $text, $font, $size, $color);
  $pdf->rectangle($w - 16 - 36, $y - 2, 36, $text_height + 4, array(0.5,0.5,0.5), 0.5);
    

  $pdf->close_object();
  //$pdf->add_object($initials);
 
// Mark the document as a duplicate
// $pdf->text(110, $h - 240, "DUPLICATE", Font_Metrics::get_font("verdana", "bold"),110, array(0.85, 0.85, 0.85), 0, -52);

  $text = "Muka {PAGE_NUM} daripada {PAGE_COUNT}";  

  // Center the text
  $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script>

</body>
</html>
<?php
mysql_free_result($pengeluaran);
?>