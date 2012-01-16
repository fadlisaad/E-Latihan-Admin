<?php
/**
 * Copyright 2009-2012 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * Update by: Jourdien
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Delete executed here.
 */
	//Include database connection details
	require_once '../login/config.php';
	
	//Include session
	require_once '../login/auth.php';
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	if (isset($_GET['id'])) {
		
		$id		= $_GET['id'];
		$type	= $_GET['type'];
		
		if ($type == 1) {
		$var = 'kursus';
			}
		else {
			$var = 'latihan';
			}
		// delete kursus/latihan
		$delete_kursus = "DELETE FROM ts_".$var." WHERE ts_".$var."_id = ".$id."";
		mysql_query($delete_kursus) or die(mysql_error());
		
		header("Location: index.php"); /* Redirect browser */
		/* Make sure that code below does not get executed when we redirect. */
		exit;
	}
	else {
		echo "Tiada ID kursus";
	}

?>