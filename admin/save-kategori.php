<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * Update by: Jourdien
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Save kategori.
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
	
	if (isset($_POST['id'])) {

		$kategori	= $_POST['value'];
		$id			= $_POST['id'];
		
		$updateSQL = "UPDATE ts_kategori SET ts_kategori_nama = '$kategori' WHERE ts_kategori_ID = '$id'";
		
		mysql_query($updateSQL) or die(mysql_error()); 
	}
?>
<div class="kategori" id="<?php echo $_POST['id']; ?>"><?php echo $_POST['value']; ?></div>