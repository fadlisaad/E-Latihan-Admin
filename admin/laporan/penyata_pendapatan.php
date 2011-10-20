<?php require_once('../../Connections/ts_kursus.php'); ?>
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

$colname_penyata = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_penyata = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_penyata = sprintf("SELECT COUNT(ts_peserta.ts_peserta_status) AS peserta, ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_kod, ts_kursus.ts_kursus_lokasi, ts_kursus.ts_kursus_tarikh_mula, ts_kursus.ts_kursus_harga,ts_expense.*, ts_admin.ts_admin_ID, ts_admin.ts_admin_nama FROM ts_kursus, ts_peserta, ts_expense, ts_admin WHERE ts_kursus.ts_kursus_id=%s AND ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status AND ts_expense.ts_expense_status=ts_kursus.ts_kursus_id AND ts_admin.ts_admin_ID=ts_kursus.ts_kursus_admin GROUP BY ts_peserta.ts_peserta_status ORDER BY COUNT(ts_peserta.ts_peserta_status) DESC", GetSQLValueString($colname_penyata, "int"));
$penyata = mysql_query($query_penyata, $ts_kursus) or die(mysql_error());
$row_penyata = mysql_fetch_assoc($penyata);
$totalRows_penyata = mysql_num_rows($penyata);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Penyata Pendapatan</title>
</head>

<body>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="8"><h2 align="center">Program Latihan<br />
    Pusat Perkhidmatan Teknikal</h2>
      <h3 align="center">Penyata Pendapatan dan Perbelanjaan Kursus (Anggaran)</h3></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">TAJUK KURSUS</td>
    <td width="12">:</td>
    <td colspan="4"><?php echo ucwords($row_penyata['ts_kursus_nama']); ?></td>
  </tr>
  <tr>
    <td colspan="3">TEMPAT KURSUS</td>
    <td>:</td>
    <td colspan="4"><?php echo ucwords($row_penyata['ts_kursus_lokasi']); ?></td>
  </tr>
  <tr>
    <td colspan="3">KOD KURSUS</td>
    <td>:</td>
    <td colspan="4"><?php echo $row_penyata['ts_kursus_kod']; ?></td>
  </tr>
  <tr>
    <td colspan="3">TARIKH</td>
    <td>:</td>
    <td colspan="4"><?php echo ucwords($row_penyata['ts_kursus_tarikh_mula']); ?></td>
  </tr>
  <tr>
    <td colspan="3">JUMLAH PESERTA</td>
    <td>:</td>
    <td colspan="4"><?php echo $row_penyata['peserta']; ?></td>
  </tr>
  <tr>
    <td colspan="3">YURAN *SEORANG/PAKEJ</td>
    <td>:</td>
    <td colspan="4">RM <?php echo $row_penyata['ts_kursus_harga']; ?></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" style="text-decoration:underline">PENDAPATAN</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td width="28">&nbsp;</td>
    <td width="23">1.</td>
    <td width="273">Jumlah Yuran</td>
    <td>&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="23">:</td>
    <td width="150"><div align="right">RM <?php echo ($row_penyata['ts_kursus_harga']*$row_penyata['peserta']) ?></div></td>
    <td width="217"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>2.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_yuran2']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>3.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_yuran3']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>4.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_yuran4']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">RM <?php echo ($row_penyata['ts_expense_yuran2']+$row_penyata['ts_expense_yuran3']+$row_penyata['ts_expense_yuran4']+($row_penyata['ts_kursus_harga']*$row_penyata['peserta'])) ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-decoration:underline">PERBELANJAAN</td>
    <td>&nbsp;</td>
    <td style="text-decoration:underline">NO KOD</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>1.</td>
    <td>Penginapan</td>
    <td>:</td>
    <td>21000</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_penginapan']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>2.</td>
    <td>Tuntutan Perjalanan/Tol</td>
    <td>:</td>
    <td>21000</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_tol']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>3.</td>
    <td>Tambang Kapal Terbang</td>
    <td>:</td>
    <td>21100</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_kapal']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>4.</td>
    <td>Sewa Dewan</td>
    <td>:</td>
    <td>24000</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_sewa']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>5.</td>
    <td>Alatan Amali:</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Bahan Makanan &amp; Minuman</td>
    <td>:</td>
    <td>25000</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_amali1']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Alat Ganti &amp; Bahan Mentah</td>
    <td>:</td>
    <td>26000</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_amali2']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Bekalan &amp; Bahan lain</td>
    <td>:</td>
    <td>27000</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_amali3']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>6.</td>
    <td>Buku/Nota/Alat tulis</td>
    <td>:</td>
    <td>27000</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_alatulis']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>7.</td>
    <td>Honorarium/Saguhati</td>
    <td>:</td>
    <td>29000</td>
    <td>:</td>
    <td>
      <div align="right">RM <?php echo $row_penyata['ts_expense_honorarium']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>8.</td>
    <td>Makanan</td>
    <td>:</td>
    <td>29000</td>
    <td>:</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_makanan']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>9.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_9']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>10.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_10']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>11.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_11']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>12.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">RM <?php echo $row_penyata['ts_expense_12']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>JUMLAH PERBELANJAAN</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><div align="right">RM <?php echo ($row_penyata['ts_expense_penginapan']+$row_penyata['ts_expense_tol']+$row_penyata['ts_expense_kapal']+$row_penyata['ts_expense_sewa']+$row_penyata['ts_expense_amali1']+$row_penyata['ts_expense_amali2']+$row_penyata['ts_expense_amali3']+$row_penyata['ts_expense_alatulis']+$row_penyata['ts_expense_honorarium']+$row_penyata['ts_expense_makanan']+$row_penyata['ts_expense_9']+$row_penyata['ts_expense_10']+$row_penyata['ts_expense_11']+$row_penyata['ts_expense_12']) ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>LEBIHAN/KURANGAN(+/-)</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">RM <?php echo (($row_penyata['ts_expense_yuran2']+$row_penyata['ts_expense_yuran3']+$row_penyata['ts_expense_yuran4']+($row_penyata['ts_kursus_harga']*$row_penyata['peserta']))-($row_penyata['ts_expense_penginapan']+$row_penyata['ts_expense_tol']+$row_penyata['ts_expense_kapal']+$row_penyata['ts_expense_sewa']+$row_penyata['ts_expense_amali1']+$row_penyata['ts_expense_amali2']+$row_penyata['ts_expense_amali3']+$row_penyata['ts_expense_alatulis']+$row_penyata['ts_expense_honorarium']+$row_penyata['ts_expense_makanan']+$row_penyata['ts_expense_9']+$row_penyata['ts_expense_10']+$row_penyata['ts_expense_11']+$row_penyata['ts_expense_12'])) ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Disediakan oleh:</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Nama</td>
    <td>:</td>
    <td colspan="4"><?php echo ucwords($row_penyata['ts_admin_nama']); ?></td>
  </tr>
  <tr>
    <td colspan="3">Jawatan</td>
    <td>:</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Tarikh</td>
    <td>:</td>
    <td colspan="4"><?php echo date('d/m/Y'); ?></td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($penyata);
?>
