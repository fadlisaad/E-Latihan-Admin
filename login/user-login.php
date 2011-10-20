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
		<title><?php echo _("Login"); ?></title>
		<link type="text/css" rel="stylesheet" href="../files/common1.css">
		<link type="text/css" rel="stylesheet" href="../files/master1.css">
</head>
<body style="background: rgb(246, 245, 238) none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
<div id="signin_wrapper">
<h3><?php echo _("Log in to MardiLMS"); ?></h3>
<form id="loginForm" name="loginForm" method="post" action="user-login-exec.php">
<span id="msgbox" style="display:none"></span>
<label class="big_i" for="username"><?php echo _("IC No"); ?>:</label>
	<input class="big_i" value="" name="login" id="login" maxlength="50" type="text"><br>
    <label class="big_i" for="password"><?php echo _("Password"); ?>:</label>
    <input class="big_i" value="" name="password" maxlength="15" type="password" id="password"><br>
    <div class="remember_holder">
    <input id="remember" name="remember" checked="checked" value="yes" type="checkbox">
    <label for="remember" class="small"><?php echo _("Remember me on this computer"); ?></label>
    </div>

    <div style="float: right; width: 180px; padding-top: 20px; font-size: 11px; text-align: right;"><a href="../reset.php"><?php echo _("Forgot your password?"); ?></a><br>
    </div>
    <input name="submit" value="Login" class="butt" type="submit">
</form>
<p class="bottom"><?php echo _("<a href=\"?locale=ms_MY\">Bahasa Melayu</a>"); ?> | <?php echo _("All copyright reserved &copy; 2009 MardiLMS"); ?></p>
</div>
</body></html>