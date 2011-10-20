<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * Update by: Jourdien
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Padam kursus executed here.
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
		
		$kursus_id	= $_GET['id'];
		
		$delete_kursus = "DELETE FROM ts_kursus WHERE ts_kursus_id = $kursus_id";
		mysql_query($delete_kursus) or die(mysql_error());
		header("Location: index.php"); /* Redirect browser */
		/* Make sure that code below does not get executed when we redirect. */
		exit;
	}
	else {
		echo "Tiada ID kursus";
	}

?>