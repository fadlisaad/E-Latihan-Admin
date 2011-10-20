<?php require_once('Connections/ts_kursus.php'); ?>
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

$colname_change = "-1";
if (isset($_GET['ts_session'])) {
  $colname_change = $_GET['ts_session'];
}
$colname2_change = "-1";
if (isset($_GET['ts_id'])) {
  $colname2_change = $_GET['ts_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_change = sprintf("SELECT ts_peserta_ID, ts_peserta_password FROM ts_peserta WHERE ts_peserta_password = %s AND ts_peserta_ID = %s", GetSQLValueString($colname_change, "text"),GetSQLValueString($colname2_change, "int"));
$change = mysql_query($query_change, $ts_kursus) or die(mysql_error());
$row_change = mysql_fetch_assoc($change);
$totalRows_change = mysql_num_rows($change);

/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/ts
 * 
 * Description : main script for reset lost password
 */
	error_reporting(0);
	ini_set("display_errors", 0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Reset kata laluan</title>
		<link type="text/css" rel="stylesheet" href="files/common1.css">
		<link type="text/css" rel="stylesheet" href="files/master1.css">
</head>
<body style="background: rgb(246, 245, 238) none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
<div id="signin_wrapper">
<h3>Tukar kata laluan anda
  
</h3>
  <form action="" method="POST" id="change-password">
  <input name="ts_id" type="hidden" id="ts_id" value="<?php echo $_GET['ts_id']; ?>" />
    <label class="big_i" for="password">Kata laluan yang baru:</label>
    <input name="password" type="text" class="big_i" id="password" value="">   
    <div style="float: right; width: 120px; padding-top: 20px; font-size: 11px; text-align: right;"><a href="login/login.php">Kembali ke login</a></div>
    <input name="submit" value="Tukar" class="butt" type="submit">
  </form>
<p class="bottom">Hakcipta terpelihara &copy; 2010 E-Latihan MARDI<?php echo $row_change['ts_peserta_ID']; ?></p>
</div>
</body></html>
<?php
mysql_free_result($change);
?>