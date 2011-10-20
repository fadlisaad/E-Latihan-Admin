<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 *
 * Description : main script for autehntication.
 */
	//Put all error state to 0
	error_reporting(0);
	
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_ADMIN_ID']) || (trim($_SESSION['SESS_ADMIN_ID']) == '')) {
		header("location: access-denied.php");
		exit();
	}
?>