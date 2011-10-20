<?php 
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, znasystem@apadmedia.com, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script to check for user validity.
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>MardiLMS - Check Status</title>
		<link type="text/css" rel="stylesheet" href="files/common1.css">
		<link type="text/css" rel="stylesheet" href="files/master1.css">
</head>
<body style="background: rgb(246, 245, 238) none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
<div id="signin_wrapper">
<h3><?php echo _("Check Registration Status"); ?></h3>
<?php include('check/movement.php'); ?>
<br>
<div style="float: right; width: 120px; padding-top: 20px; font-size: 11px; text-align: right;"><a href="#"><?php echo _("Help?"); ?></a></div>
<p class="bottom"><?php echo _("<a href=\"?locale=ms_MY\">Bahasa Melayu</a>"); ?> | <?php echo _("All copyright reserved &copy; 2009 MardiLMS"); ?></p>
</div>
</body></html>
