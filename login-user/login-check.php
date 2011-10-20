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

$colname_check_user = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_check_user = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_check_user = sprintf("SELECT ts_kursus_id, ts_kursus_nama FROM ts_kursus WHERE ts_kursus_id = %s", GetSQLValueString($colname_check_user, "int"));
$check_user = mysql_query($query_check_user, $ts_kursus) or die(mysql_error());
$row_check_user = mysql_fetch_assoc($check_user);
$totalRows_check_user = mysql_num_rows($check_user);

/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script for Login.
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Pendaftaran</title>
		<link type="text/css" rel="stylesheet" href="../files/common1.css">
		<link type="text/css" rel="stylesheet" href="../files/master1.css">
        <script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
        </script>
</head>
<body>
<div id="signin_wrapper1">
<form action="login-exec-check.php?ts_kursus_id=<?php echo $row_check_user['ts_kursus_id']; ?>" method="post" name="loginForm" id="loginForm">
<table width="100%">
  <tr>
    <td colspan="2"><h3>Pendaftaran</h3></td>
    <td colspan="2"><h3>Login</h3></td>
    </tr>
  <tr>
    <td width="48%" rowspan="3"><label class="big_i" for="username">Pertama kali mendaftar? Klik pada pautan dibawah ini untuk mendaftar. Jika anda telah mendaftar sebelum ini, sila gunakan borang login disebelah.</label></td>
    <td width="5%">&nbsp;</td>
    
    <td width="45%"><label class="big_i" for="username">No Kad Pengenalan:</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="45%"><input class="big_i" value="" name="login" id="login" maxlength="50" type="text" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="45%"><label class="big_i" for="label">Kata Laluan:</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="48%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="45%"><input class="big_i" value="" name="password" maxlength="15" type="password" id="password" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="48%"><input name="daftar" type="button" class="butt" onclick="MM_goToURL('parent','http://elearn.mardi.gov.my/ts/user/tambah-peserta.php?ts_kursus_id=<?php echo $row_check_user['ts_kursus_id']; ?>');return document.MM_returnValue" value="Daftar"/></td>
    <td width="5%">&nbsp;</td>
    <td width="45%"><input name="submit" type="submit" class="butt" id="submit" value="Login" />
      </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="../reset-user.php">Lupa kata laluan?</a></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<p class="bottom">Hakcipta Terpelihara &copy; 2009-2010 e-Latihan, MARDI</p>
</div>
</body></html>
<?php
mysql_free_result($check_user);
?>