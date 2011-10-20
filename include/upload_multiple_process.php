<?php
	/**
	 * Copyright 2009-2011 MARDI
	 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
	 * This file is part of MARDILMS.
	 * The latest code can be found at http://elearn.mardi.gov.my/
	 * 
	 * Description : processing upload multiple files.
	 */
	error_reporting(0);
	require_once ('../localization.php');
	
	// I18N support information here
	$language = 'en';
	putenv("LANG=$language"); 
	setlocale(LC_ALL, $language);
	
	// Set the text domain as 'messages'
	$domain = 'mardilms';
	bindtextdomain($domain, "/www/mardilms/ts/locale"); 
	textdomain($domain);

	//set where you want to store files
	//in this example we keep file in folder upload
	//$HTTP_POST_FILES['ufile']['name']; = upload file name
	//for example upload file name cartoon.gif . $path will be upload/cartoon.gif
	$path1= "upload/".$HTTP_POST_FILES['ufile']['name'][0];
	$path2= "upload/".$HTTP_POST_FILES['ufile']['name'][1];
	$path3= "upload/".$HTTP_POST_FILES['ufile']['name'][2];
	
	//copy file to where you want to store file
	copy($HTTP_POST_FILES['ufile']['tmp_name'][0], $path1);
	copy($HTTP_POST_FILES['ufile']['tmp_name'][1], $path2);
	copy($HTTP_POST_FILES['ufile']['tmp_name'][2], $path3);
	
	//$HTTP_POST_FILES['ufile']['name'] = file name
	//$HTTP_POST_FILES['ufile']['size'] = file size
	//$HTTP_POST_FILES['ufile']['type'] = type of file
	echo "File Name :".$HTTP_POST_FILES['ufile']['name'][0]."<BR/>";
	echo "File Size :".$HTTP_POST_FILES['ufile']['size'][0]."<BR/>";
	echo "File Type :".$HTTP_POST_FILES['ufile']['type'][0]."<BR/>";
	echo "<img src=\"$path1\" width=\"150\" height=\"150\">";
	echo "<P>";
	
	echo "File Name :".$HTTP_POST_FILES['ufile']['name'][1]."<BR/>";
	echo "File Size :".$HTTP_POST_FILES['ufile']['size'][1]."<BR/>";
	echo "File Type :".$HTTP_POST_FILES['ufile']['type'][1]."<BR/>";
	echo "<img src=\"$path2\" width=\"150\" height=\"150\">";
	echo "<P>";
	
	echo "File Name :".$HTTP_POST_FILES['ufile']['name'][2]."<BR/>";
	echo "File Size :".$HTTP_POST_FILES['ufile']['size'][2]."<BR/>";
	echo "File Type :".$HTTP_POST_FILES['ufile']['type'][2]."<BR/>";
	echo "<img src=\"$path3\" width=\"150\" height=\"150\">";
	
	///////////////////////////////////////////////////////
	
	// Use this code to display the error or success.
	
	$filesize1=$HTTP_POST_FILES['ufile']['size'][0];
	$filesize2=$HTTP_POST_FILES['ufile']['size'][1];
	$filesize3=$HTTP_POST_FILES['ufile']['size'][2];
	
	if($filesize1 && $filesize2 && $filesize3 != 0)
	{
	echo "File(s) has been uploaded successfully";
	}
	
	else {
	echo "ERROR.....";
	}
	
	//////////////////////////////////////////////
	
	// What files that have a problem? (if found)
	
	if($filesize1==0) {
	echo "There're something error in your first file";
	echo "<BR />";
	}
	
	if($filesize2==0) {
	echo "There're something error in your second file";
	echo "<BR />";
	}
	
	if($filesize3==0) {
	echo "There're something error in your third file";
	echo "<BR />";
	}

?>