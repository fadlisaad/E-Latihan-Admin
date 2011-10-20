<?php
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
		<title>Pengesahan E-mail</title>
		<link type="text/css" rel="stylesheet" href="../files/common1.css">
		<link type="text/css" rel="stylesheet" href="../files/master1.css">
</head>
<body>
<div id="signin_wrapper">
<form action="verify-check.php" method="post" name="loginForm" id="loginForm">
<table width="100%">
  <tr>
    <td colspan="2"><h3>Pengesahan</h3></td>
    </tr>
  <tr>
    <td width="45%"><label class="big_i" for="username">No Kad Pengenalan:</label></td>
  </tr>
  <tr>
    <td width="45%"><input class="big_i" value="<?php echo $_GET['ic']; ?>" name="login" id="login" maxlength="50" type="text" /></td>
    </tr>
  <tr>
    <td>Password:</td>
  </tr>
  <tr>
    <td><input class="big_i" value="<?php echo $_GET['ts']; ?>" name="password" id="password" maxlength="50" type="password" /></td>
  </tr>
  <tr>
    <td width="45%"><label class="big_i" for="label">Pengesahan anda adalah perlu untuk memastikan bahawa alamat e-mail anda adalah sahih seperti dalam data kami.</label></td>
    </tr>
  <tr>
    <td width="45%">
      <input name="kursus_id" type="hidden" id="kursus_id" value="<?php echo $_GET['kursus_id']; ?>" />
      <input type="hidden" name="invoice" id="invoice" value="<?php echo $_GET['invoice']; ?>"/>
      <input type="hidden" name="registerDate" id="registerDate" value="<?php echo date('Y-m-d'); ?>"/></td>
    </tr>
  <tr>
    <td width="45%"><input name="submit" type="submit" class="butt" id="submit" value="Pengesahan" />      </td>
    </tr>
</table>
</form>
<p class="bottom">Hakcipta Terpelihara &copy; 2009-2010 e-Latihan, MARDI</p>
</div>
</body></html>