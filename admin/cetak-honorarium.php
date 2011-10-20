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

$colname_bayaran = "-1";
if (isset($_GET['instruct_id'])) {
  $colname_bayaran = $_GET['instruct_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_bayaran = sprintf("SELECT DISTINCT ts_topic.topic_id, ts_instructor.*, SUM(ts_topic.topic_rate*ts_topic.topic_hour) AS jumlah,ts_topic.topic_title, ts_topic.topic_rate, ts_kursus.ts_kursus_kod, ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_lokasi, ts_kursus.ts_kursus_tarikh_mula, ts_kursus.ts_kursus_tarikh_tamat, ts_kursus.ts_kursus_lokasi FROM ts_instructor, ts_topic, ts_kursus WHERE ts_instructor.instruct_id = %s AND ts_topic.topic_instructor=ts_instructor.instruct_name GROUP BY ts_topic.topic_title", GetSQLValueString($colname_bayaran, "int"));
$bayaran = mysql_query($query_bayaran, $ts_kursus) or die(mysql_error());
$row_bayaran = mysql_fetch_assoc($bayaran);
$totalRows_bayaran = mysql_num_rows($bayaran);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="842">
  <tr>
    <td width="200" rowspan="2"><div align="center">PENYATA BAYARAN<br />
    HONORARIUM</div></td>
    <td colspan="2"><div align="right">Kod Kursus: <?php echo $row_bayaran['ts_kursus_kod']; ?></div></td>
  </tr>
  <tr>
    <td width="603"><div align="center"><?php echo $row_bayaran['ts_kursus_nama']; ?></div></td>
    <td width="200">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="center"><?php echo $row_bayaran['ts_kursus_tarikh_mula']; ?> hingga <?php echo $row_bayaran['ts_kursus_tarikh_tamat']; ?><br />
    <?php echo $row_bayaran['ts_kursus_lokasi']; ?></div></td>
    <td width="200">&nbsp;</td>
  </tr>
</table>
<table width="842">
  <tr>
    <td>Bil</td>
    <td>Penceramah / Pengendali Amali</td>
    <td>Tajuk Ceramah</td>
    <td>Tarikh</td>
    <td>Masa/Kadar</td>
    <td>Jumlah (RM)</td>
  </tr>
  <tr>
    <td>1</td>
    <td><?php echo $row_bayaran['instruct_name']; ?></td>
    <td><?php echo $row_bayaran['topic_title']; ?></td>
    <td>&nbsp;</td>
    <td><?php echo $row_bayaran['topic_rate']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($bayaran);
?>
