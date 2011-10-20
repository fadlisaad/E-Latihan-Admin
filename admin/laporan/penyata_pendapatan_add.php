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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add")) {
  $insertSQL = sprintf("INSERT INTO ts_expense (ts_expense_status, ts_expense_yuran2, ts_expense_yuran3, ts_expense_yuran4, ts_expense_penginapan, ts_expense_tol, ts_expense_kapal, ts_expense_sewa, ts_expense_amali1, ts_expense_amali2, ts_expense_amali3, ts_expense_alatulis, ts_expense_honorarium, ts_expense_makanan, ts_expense_9, ts_expense_10, ts_expense_11, ts_expense_12) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ts_kursus_id'], "int"),
                       GetSQLValueString($_POST['yuran1'], "int"),
                       GetSQLValueString($_POST['yuran2'], "int"),
                       GetSQLValueString($_POST['yuran3'], "int"),
                       GetSQLValueString($_POST['penginapan'], "int"),
                       GetSQLValueString($_POST['toll'], "int"),
                       GetSQLValueString($_POST['kapal'], "int"),
                       GetSQLValueString($_POST['sewa'], "int"),
                       GetSQLValueString($_POST['amali1'], "int"),
                       GetSQLValueString($_POST['amali2'], "int"),
                       GetSQLValueString($_POST['amali3'], "int"),
                       GetSQLValueString($_POST['stationary'], "int"),
                       GetSQLValueString($_POST['honor'], "int"),
                       GetSQLValueString($_POST['makanan'], "int"),
                       GetSQLValueString($_POST['ex9'], "int"),
                       GetSQLValueString($_POST['ex10'], "int"),
                       GetSQLValueString($_POST['ex11'], "int"),
                       GetSQLValueString($_POST['ex12'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "../list-penyata.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_penyata = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_penyata = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_penyata = sprintf("SELECT COUNT(ts_peserta.ts_peserta_status) AS peserta, ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_kod, ts_kursus.ts_kursus_lokasi, ts_kursus.ts_kursus_tarikh_mula, ts_kursus.ts_kursus_harga, ts_admin.ts_admin_ID, ts_admin.ts_admin_nama FROM ts_kursus, ts_peserta,  ts_admin WHERE ts_kursus.ts_kursus_id=%s GROUP BY ts_peserta.ts_peserta_status ORDER BY COUNT(ts_peserta.ts_peserta_status) DESC", GetSQLValueString($colname_penyata, "int"));
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
<form action="<?php echo $editFormAction; ?>" id="add" name="add" method="POST">
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
    <td colspan="3">TAJUK KURSUS
      <input name="ts_kursus_id" type="hidden" id="ts_kursus_id" value="<?php echo $_GET['ts_kursus_id']; ?>" /></td>
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
    <td width="150"><div align="right">
      RM <?php echo ($row_penyata['ts_kursus_harga']*$row_penyata['peserta']); ?></td>
    <td width="217">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>2.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><div align="right"><input type="text" name="yuran1" id="yuran1" /></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>3.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="yuran2" id="yuran2" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>4.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="yuran3" id="yuran3" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <td><div align="right">
      <input type="text" name="penginapan" id="penginapan" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>2.</td>
    <td>Tuntutan Perjalanan/Tol</td>
    <td>:</td>
    <td>21000</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="toll" id="toll" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>3.</td>
    <td>Tambang Kapal Terbang</td>
    <td>:</td>
    <td>21100</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="kapal" id="kapal" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>4.</td>
    <td>Sewa Dewan</td>
    <td>:</td>
    <td>24000</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="sewa" id="sewa" />
    </div></td>
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
    <td><div align="right">
      <input type="text" name="amali1" id="amali1" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Alat Ganti &amp; Bahan Mentah</td>
    <td>:</td>
    <td>26000</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="amali2" id="amali2" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Bekalan &amp; Bahan lain</td>
    <td>:</td>
    <td>27000</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="amali3" id="amali3" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>6.</td>
    <td>Buku/Nota/Alat tulis</td>
    <td>:</td>
    <td>27000</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="stationary" id="stationary" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>7.</td>
    <td>Honorarium/Saguhati</td>
    <td>:</td>
    <td>29000</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="honor" id="honor" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>8.</td>
    <td>Makanan</td>
    <td>:</td>
    <td>29000</td>
    <td>:</td>
    <td><div align="right">
      <input type="text" name="makanan" id="makanan" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>9.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">
      <input type="text" name="ex9" id="ex9" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>10.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">
      <input type="text" name="ex10" id="ex10" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>11.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">
      <input type="text" name="ex11" id="ex11" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>12.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">
      <input type="text" name="ex12" id="ex12" />
    </div></td>
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
    <td></td>
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
    <td></td>
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
<p>
  <input type="submit" name="update" id="update" value="Submit" />
</p>

<input type="hidden" name="MM_insert" value="add" />
</form>
<p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($penyata);
?>