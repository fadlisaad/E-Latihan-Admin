<?php
	/**
	 * Copyright 2009-2011 MARDI
	 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
	 * This file is part of MARDILMS.
	 * The latest code can be found at http://elearn.mardi.gov.my/
	 * Last update:28-Dec-2009 8:57 PM
	 * Description : main script for login processing.
	 */
	//Start session
	session_start();
	
	//Include database connection details
	//Database definition. Please change this to your database environment
	define('DB_HOST', '');	//Your hosting. 99% you don't need to change this
    	define('DB_USER', '');			//Your MySQL username
    	define('DB_PASSWORD', '');	//Your MySQL password
    	define('DB_DATABASE', '');	//Database that contain the application data
	
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
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM ts_peserta WHERE ts_peserta_ic = '".$login."' AND ts_peserta_password = '".$password."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['SESS_ADMIN_ID'] = $member['ts_peserta_ID'];
			$_SESSION['SESS_USERNAME'] = $member['ts_peserta_ic'];
			$_SESSION['SESS_FULLNAME'] = $member['ts_peserta_nama'];
			$_SESSION['SESS_PHONE'] = $member['ts_peserta_handphone'];
			$_SESSION['SESS_EMAIL'] = $member['ts_peserta_email'];
			$_SESSION['SESS_KURSUS'] = $member['ts_peserta_status'];
			$_SESSION['SESS_PASSWORD'] = $member['ts_peserta_password'];
			$_SESSION['SESS_YEAR'] = $member['ts_peserta_year'];
			session_write_close();
			header("location:user.php?ts_peserta_ic=".$_SESSION['SESS_USERNAME']."");
			exit();
		}else {
			//Login failed
			header("location:access-denied.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>
