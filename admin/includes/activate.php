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

$colname_e_mail = "-1";
if (isset($_GET['ts_peserta_ID'])) {
  $colname_e_mail = $_GET['ts_peserta_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_e_mail = sprintf("SELECT * FROM ts_peserta, ts_kursus WHERE ts_peserta_ID = %s AND ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status", GetSQLValueString($colname_e_mail, "int"));
$e_mail = mysql_query($query_e_mail, $ts_kursus) or die(mysql_error());
$row_e_mail = mysql_fetch_assoc($e_mail);
$totalRows_e_mail = mysql_num_rows($e_mail);

mysql_free_result($e_mail);
?>