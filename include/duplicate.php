<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script for login processing.
 */
	//Start session
	session_start();
	
	//Include database connection details
	require_once('../login/config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
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

	function MysqlCopyRow($TableName, $IDFieldName, $IDToDuplicate) {
		if ($TableName AND $IDFieldName AND $IDToDuplicate > 0) {
			$sql = "SELECT * FROM $TableName WHERE $IDFieldName = $IDToDuplicate";
			$result = @mysql_query($sql);
			if ($result) {
				$sql = "INSERT INTO $TableName SET ";
				$row = mysql_fetch_array($result);
				$RowKeys = array_keys($row);
				$RowValues = array_values($row);
				for ($i=3;$i<count($RowKeys);$i+=2) {
					if ($i!=3) { $sql .= ", "; }
					$sql .= $RowKeys[$i] . " = '" . $RowValues[$i] . "'";
				}
				$result = @mysql_query($sql);
				print_r($sql);
			}
		}
	}
if(isset($_GET['id'])){

	$kursus_id 	= $_GET['id']; //The id of the product you want to copy
	$newyear	= $_GET['year'];
	
	MysqlCopyRow("ts_kursus","ts_kursus_id",$kursus_id);
	
	$query 	= "SELECT ts_kursus_id FROM ts_kursus ORDER BY ts_kursus_id DESC LIMIT 1";
	$result = @mysql_query($query);
	$row 	= mysql_fetch_array($result);
	$newid	= $row['ts_kursus_id'];
	
	$update_year = "UPDATE ts_kursus SET ts_kursus_year = '$newyear' WHERE ts_kursus_id = $newid";
	$result_year = @mysql_query($update_year);
	
	header("Location: ../admin/ubah-kursus.php?ts_kursus_id=" . $row['ts_kursus_id'] . ""); /* Redirect browser */
	/* Make sure that code below does not get executed when we redirect. */
	exit;
}
else {
	echo "Error!";
}
?>