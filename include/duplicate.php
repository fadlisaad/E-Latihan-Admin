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

	$id 		= $_GET['id'];
	$newyear	= $_GET['year'];
	$type		= $_GET['type'];
	
	if ($type == 1) {
		$var = 'kursus';
		}
	else {
		$var = 'latihan';
		}
	MysqlCopyRow("ts_".$var,"ts_".$var."_id",$id);
	
	$query 	= "SELECT ts_".$var."_id FROM ts_".$var." ORDER BY ts_".$var."_id DESC LIMIT 1";
	$result = @mysql_query($query);
	$row 	= mysql_fetch_array($result);
	$newid	= $row['ts_'.$var.'_id'];
	
	$update_year = "UPDATE ts_".$var." SET ts_".$var."_year = ".$newyear." WHERE ts_".$var."_id = $newid";
	$result_year = @mysql_query($update_year);
	
	header("Location: ../admin/ubah-".$var.".php?ts_".$var."_id=" . $row['ts_'.$var.'_id'] . ""); /* Redirect browser */
	/* Make sure that code below does not get executed when we redirect. */
	exit;
}
else {
	echo "Error!";
}
?>