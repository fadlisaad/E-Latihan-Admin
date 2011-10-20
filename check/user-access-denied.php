<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script for denying access to the backend.
 */
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo _("Access Denied"); ?></title>
<link href="../files/common1.css" rel="stylesheet" type="text/css" />
<link href="../files/master1.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="signin_wrapper">
<h1><?php echo _("Access Denied"); ?></h1>
<p align="center">&nbsp;</p>
<h4 align="center" class="err"><?php echo _("Access Denied"); ?><br />
<?php echo _("You do not have authorization to access this resource."); ?></h4>
<p align="center" class="err"><a href="user-login.php">Click here to login</a></p>
</div>
</body>
</html>
