<?php
	//Include database connection details
	require_once('../login/config.php');

	// Make a MySQL Connection
	mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
	mysql_select_db(DB_DATABASE) or die(mysql_error());

	// GET the post ID
	if (isset($_GET['peserta_id'])) {
		$id 	= $_GET['peserta_id'];
		$kursus = $_GET['kursus_id'];
		
		// Retrieve all the data from the table
		$result = mysql_query("DELETE FROM ts_invoice WHERE peserta_id = $id AND kursus_id=$kursus")
		or die(mysql_error());  
		
		// return to previous page
		header('Location:list-peserta-kursus.php?ts_kursus_id='.$kursus.'');
}
?>