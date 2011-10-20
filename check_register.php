<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, znasystem@apadmedia.com, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script for checking user validity.
 */
	if(!isset($_GET['ts_peserta_ic'])){ 	// If they are trying to view this without ?username=username or ?password=password.
    die("What’s this document for?"); 		// Lawl what is this document for anyways?
	}
	elseif(isset($_GET['ts_peserta_ic'])){ 	// ElseIf they are want to check their username.
    require('login-user/config.php'); 			// Requires config.php so we can access the database.
	
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
    
	$user=stripslashes(strip_tags(htmlspecialchars($_GET['ts_peserta_ic'], ENT_QUOTES))); // Cleans all nasty input from the username.
    $check=mysql_query("SELECT * FROM ts_peserta WHERE ts_peserta_ic = ".$user." AND active = 0"); // Checks to see if a user is in the `users` table or not.
   
        if($check == 0){ // If there is no username in the database that matches the input one.
            echo ''.$user.' is <span style="color:#009933">Available!</span>'; // Yay we can use it.
        }elseif($check != 0){ // ElseIf there is a username in the database.
            echo ''.$user.' is <span style="color:#CC0000">Not Available!</span>'; // None for you higgans.
        } // End ElseIf.
       
} // End ElseIf.
?>