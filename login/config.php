<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, znasystem@apadmedia.com, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script for configuration.
 */
	//Error state
	error_reporting(0);					//currently set to 0 (for production), E_ALL (for development)
	
	//Database definition. Please change this to your database environment
	define('DB_HOST', 'localhost:/tmp/mysql/melanie.sock');		//Your hosting. 99% you don't need to change this
    define('DB_USER', 'tiara');			//Your MySQL username
    define('DB_PASSWORD', 'MIarNgYj');	//Your MySQL password
    define('DB_DATABASE', 'melanie');	//Database that contain the application data
?>