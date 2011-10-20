<?php require_once('Connections/ts_kursus.php'); ?>
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

if ((isset($_GET['kursus_list_ID'])) && ($_GET['kursus_list_ID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ts_peserta WHERE ts_peserta_ID=%s",
                       GetSQLValueString($_GET['kursus_list_ID'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($deleteSQL, $ts_kursus) or die(mysql_error());

  $deleteGoTo = "peserta_kursus_senarai.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['kursus_list_ID'])) && ($_GET['kursus_list_ID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ts_peserta_kursus WHERE kursus_ID=%s",
                       GetSQLValueString($_GET['kursus_list_ID'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($deleteSQL, $ts_kursus) or die(mysql_error());

  $deleteGoTo = "peserta_kursus_senarai.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_delete_user = "SELECT ts_peserta.ts_peserta_nama, ts_peserta_kursus.kursus_list_nama FROM ts_peserta_kursus, ts_peserta WHERE ts_peserta.ts_peserta_nama=ts_peserta_kursus.kursus_list_nama";
$delete_user = mysql_query($query_delete_user, $ts_kursus) or die(mysql_error());
$row_delete_user = mysql_fetch_assoc($delete_user);
$totalRows_delete_user = mysql_num_rows($delete_user);

mysql_free_result($delete_user);
?>