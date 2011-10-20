<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/ts
 * 
 * Description : main script for reset lost password
 */
	require_once('Connections/ts_kursus.php');
	error_reporting(0);
	ini_set("display_errors", 0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Reset kata laluan</title>
		<link type="text/css" rel="stylesheet" href="files/common1.css" />
		<link type="text/css" rel="stylesheet" href="files/master1.css" />
</head>
<body style="background: rgb(246, 245, 238) none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
<div id="signin_wrapper">
<h3>Reset kata laluan anda</h3>
    <form action="reset-password.php" method="post">
    <label class="big_i" for="e-mail">E-mail:</label>
    <input name="e-mail" type="text" class="big_i" id="e-mail" value="" />
    <div style="float: right; width: 120px; padding-top: 20px; font-size: 11px; text-align: right;"><a href="login/login.php">Kembali ke login</a></div>
    <input name="submit" value="Reset" class="butt" type="submit" />
  </form>
<p class="bottom">Hakcipta terpelihara &copy; 2010 E-Latihan MARDI</p>
</div>
</body></html>