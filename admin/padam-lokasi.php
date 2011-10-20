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

if ((isset($_GET['ts_tempat_ID'])) && ($_GET['ts_tempat_ID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ts_tempat_kursus WHERE ts_tempat_ID=%s",
                       GetSQLValueString($_GET['ts_tempat_ID'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($deleteSQL, $ts_kursus) or die(mysql_error());

  $deleteGoTo = "list-lokasi.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_padamLokasi = "-1";
if (isset($_GET['ts_tempat_ID'])) {
  $colname_padamLokasi = $_GET['ts_tempat_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_padamLokasi = sprintf("SELECT * FROM ts_tempat_kursus WHERE ts_tempat_ID = %s", GetSQLValueString($colname_padamLokasi, "int"));
$padamLokasi = mysql_query($query_padamLokasi, $ts_kursus) or die(mysql_error());
$row_padamLokasi = mysql_fetch_assoc($padamLokasi);
$totalRows_padamLokasi = mysql_num_rows($padamLokasi);

mysql_free_result($padamLokasi);
?>