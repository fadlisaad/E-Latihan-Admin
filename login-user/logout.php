<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script for logout.Clear all session available.
 */
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_ADMIN_ID']);
	unset($_SESSION['SESS_USERNAME']);
	unset($_SESSION['SESS_FULLNAME']);
	unset($_SESSION['SESS_PASSWORD']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Logged Out</title>
<link href="../files/common1.css" rel="stylesheet" type="text/css" />
<link href="../files/master1.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-size: small
}
-->
</style>
</head>
<body>
<div id="signin_wrapper">
<div align="center" class="nav_bottom" id="butt_wel5">Log Keluar</div>
<h4 align="center" class="err">Anda telah berjaya log keluar.</h4>
<p align="center"><a href="login.php">Login</a> | <a href="../../index.php">Halaman utama</a></p>
</div>
</body>
</html>
