<?php require_once('../Connections/ts_kursus.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

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

if ((isset($_GET['ts_admin_ID'])) && ($_GET['ts_admin_ID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ts_admin WHERE ts_admin_ID=%s",
                       GetSQLValueString($_GET['ts_admin_ID'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($deleteSQL, $ts_kursus) or die(mysql_error());

  $deleteGoTo = "list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_padam = "SELECT ts_admin_ID FROM ts_admin";
$padam = mysql_query($query_padam, $ts_kursus) or die(mysql_error());
$row_padam = mysql_fetch_assoc($padam);
$totalRows_padam = mysql_num_rows($padam);

mysql_free_result($padam);
?>