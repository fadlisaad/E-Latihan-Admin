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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ts_files WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($deleteSQL, $ts_kursus) or die(mysql_error());

  $deleteGoTo = "upload-kursus.php?ts_kursus_id=" . $row_padam['ts_kursus_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_padam = "-1";
if (isset($_GET['id'])) {
  $colname_padam = $_GET['id'];
}
$colname2_padam = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname2_padam = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_padam = sprintf("SELECT id, ts_kursus.ts_kursus_id FROM ts_files, ts_kursus WHERE id = %s AND ts_kursus.ts_kursus_id=%s", GetSQLValueString($colname_padam, "int"),GetSQLValueString($colname2_padam, "int"));
$padam = mysql_query($query_padam, $ts_kursus) or die(mysql_error());
$row_padam = mysql_fetch_assoc($padam);
$totalRows_padam = mysql_num_rows($padam);

mysql_free_result($padam);
?>