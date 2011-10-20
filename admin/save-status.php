<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * Update by: Jourdien
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Ubah kursus executed here.
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
	
	if (isset($_POST['value'])) {

		$status_id	= $_POST['value'];
		$peserta_id	= $_POST['id'];
		$kursus_id	= $_POST['kursus'];
		
		$updateSQL = "UPDATE ts_invoice SET status = '$status_id' WHERE peserta_id = '$peserta_id' AND kursus_id = '$kursus_id'";
		
		mysql_query($updateSQL) or die(mysql_error()); 
	}

	$status = array('Permohonan Baru','Dalam Proses','Diterima','Batal');
?>

<span class="status" id="<?php echo $row_peserta['ts_peserta_ID']; ?>" style="display:inline"><?php echo $status[$_POST['value']-1]; ?></span>
