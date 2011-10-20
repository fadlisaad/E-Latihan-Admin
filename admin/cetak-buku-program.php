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

$colname_cetak_peserta = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_cetak_peserta = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_cetak_peserta = sprintf("SELECT ts_peserta.ts_peserta_ID, ts_peserta.ts_peserta_nama, ts_peserta.ts_peserta_handfone, ts_peserta.ts_peserta_homeline, ts_peserta.ts_peserta_alamat, ts_peserta.ts_peserta_email, ts_peserta.ts_peserta_pekerjaan, ts_peserta.ts_peserta_gambar, ts_peserta.ts_peserta_status, ts_kursus.ts_kursus_id, ts_peserta.ts_peserta_perusahaan FROM ts_peserta, ts_kursus WHERE ts_peserta.ts_peserta_status=ts_kursus.ts_kursus_id AND ts_kursus.ts_kursus_id=%s", GetSQLValueString($colname_cetak_peserta, "int"));
$cetak_peserta = mysql_query($query_cetak_peserta, $ts_kursus) or die(mysql_error());
$row_cetak_peserta = mysql_fetch_assoc($cetak_peserta);
$totalRows_cetak_peserta = mysql_num_rows($cetak_peserta);

$colname_cetak_penceramah = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_cetak_penceramah = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_cetak_penceramah = sprintf("SELECT ts_instructor.*, ts_kursus.ts_kursus_id FROM ts_instructor, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_instructor.instruct_status AND ts_kursus.ts_kursus_id=%s", GetSQLValueString($colname_cetak_penceramah, "int"));
$cetak_penceramah = mysql_query($query_cetak_penceramah, $ts_kursus) or die(mysql_error());
$row_cetak_penceramah = mysql_fetch_assoc($cetak_penceramah);
$totalRows_cetak_penceramah = mysql_num_rows($cetak_penceramah);
isset($startRow_cetak_peserta)? $orderNum=$startRow_cetak_peserta:$orderNum=0;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h3>PESERTA</h3>
<?php do { ?>
  <table width="600">
    <tr>
      <td width="1" valign="top"><span class="a-center"><?php echo ++$orderNum; ?></span></td>
      <td colspan="4" valign="top"><p><?php echo $row_cetak_peserta['ts_peserta_nama']; ?><br />
          <?php echo $row_cetak_peserta['ts_peserta_alamat']; ?></p>
        </td>
      <td width="154" rowspan="4"><img name="" src="<?php echo $row_cetak_peserta['ts_peserta_gambar']; ?>" alt="" style="background-color: #999999" /></td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td width="60">Telefon:</td>
      <td width="242"><?php echo $row_cetak_peserta['ts_peserta_homeline']; ?></td>
      <td width="100">Telefon Bimbit:</td>
      <td width="414"><?php echo $row_cetak_peserta['ts_peserta_handfone']; ?></td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td>Fax:</td>
      <td>&nbsp;</td>
      <td>E-mail:</td>
      <td><?php echo $row_cetak_peserta['ts_peserta_email']; ?></td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td>Jawatan:</td>
      <td><?php echo $row_cetak_peserta['ts_peserta_pekerjaan']; ?></td>
      <td>Bidang:</td>
      <td><?php echo $row_cetak_peserta['ts_peserta_perusahaan']; ?></td>
    </tr>
      </table>
  <?php } while ($row_cetak_peserta = mysql_fetch_assoc($cetak_peserta)); ?>
  <h3>PENCERAMAH</h3>
  <table width="600">
    <tr>
      <td width="1" valign="top"><span class="a-center"><?php echo ++$orderNum; ?></span></td>
      <td colspan="4" valign="top"><p><?php echo $row_cetak_penceramah['instruct_name']; ?><br />
        <?php echo $row_cetak_penceramah['instruct_agency_address']; ?><br />
      </p></td>
      <td width="154" rowspan="4"><img name="" src="<?php echo $row_cetak_peserta['ts_peserta_gambar']; ?>" alt="" style="background-color: #999999" /></td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td width="60">Telefon:</td>
      <td width="242"><?php echo $row_cetak_penceramah['instruct_contact']; ?></td>
      <td width="100">Telefon Bimbit:</td>
      <td width="414">&nbsp;</td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td>Fax:</td>
      <td>&nbsp;</td>
      <td>E-mail:</td>
      <td><?php echo $row_cetak_penceramah['instruct_email']; ?></td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td>Jawatan:</td>
      <td><?php echo $row_cetak_penceramah['instruct_position']; ?></td>
      <td>Bidang:</td>
      <td><?php echo $row_cetak_penceramah['instruct_agency']; ?></td>
    </tr>
  </table>
  <h3>FASILITATOR</h3>
  <table width="600">
    <tr>
      <td width="1" valign="top"><span class="a-center"><?php echo ++$orderNum; ?></span></td>
      <td colspan="4" valign="top"><p><br />
      </p></td>
      <td width="154" rowspan="4"><img name="" src="<?php echo $row_cetak_peserta['ts_peserta_gambar']; ?>" alt="" style="background-color: #999999" /></td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td width="60">Telefon:</td>
      <td width="242">&nbsp;</td>
      <td width="100">Telefon Bimbit:</td>
      <td width="414">&nbsp;</td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td>Fax:</td>
      <td>&nbsp;</td>
      <td>E-mail:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td>Jawatan:</td>
      <td>&nbsp;</td>
      <td>Bidang:</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <h3>URUSETIA</h3>
</body>
</html>
<?php
mysql_free_result($cetak_peserta);

mysql_free_result($cetak_penceramah);
?>
