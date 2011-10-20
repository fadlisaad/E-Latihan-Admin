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

if ((isset($_GET['ts_kategori_ID'])) && ($_GET['ts_kategori_ID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ts_kategori WHERE ts_kategori_ID=%s",
                       GetSQLValueString($_GET['ts_kategori_ID'], "int"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($deleteSQL, $ts_kursus) or die(mysql_error());

  $deleteGoTo = "list-kategori.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_kategori_padam = "-1";
if (isset($_GET['ts_kategori_ID'])) {
  $colname_kategori_padam = (get_magic_quotes_gpc()) ? $_GET['ts_kategori_ID'] : addslashes($_GET['ts_kategori_ID']);
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kategori_padam = sprintf("SELECT * FROM ts_kategori WHERE ts_kategori_ID = %s", $colname_kategori_padam);
$kategori_padam = mysql_query($query_kategori_padam, $ts_kursus) or die(mysql_error());
$row_kategori_padam = mysql_fetch_assoc($kategori_padam);
$totalRows_kategori_padam = mysql_num_rows($kategori_padam);

mysql_free_result($kategori_padam);
?>