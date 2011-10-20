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

if ((isset($_GET['ts_bayaran_id'])) && ($_GET['ts_bayaran_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ts_bayaran WHERE ts_bayaran_id=%s",
                       GetSQLValueString($_GET['ts_bayaran_id'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($deleteSQL, $ts_kursus) or die(mysql_error());

  $deleteGoTo = "list-bayaran-invoice.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_padam = "-1";
if (isset($_GET['ts_bayaran_id'])) {
  $colname_padam = $_GET['ts_bayaran_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_padam = sprintf("SELECT * FROM ts_bayaran WHERE ts_bayaran_id = %s", GetSQLValueString($colname_padam, "int"));
$padam = mysql_query($query_padam, $ts_kursus) or die(mysql_error());
$row_padam = mysql_fetch_assoc($padam);
$totalRows_padam = mysql_num_rows($padam);

mysql_free_result($padam);
?>