<?php
// File Uploading ...
$dir = "../upload";
$types = array("image/png","image/x-png","image/gif","image/jpeg","image/pjpeg");
$fullpath = "$dir/";

if (!empty($_FILES['topic_file']['name'])) {
	if ($_FILES['topic_file']['size'] == 0) {
		$message  = '<b>Error:</b> Image (0 byte) <p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	} elseif ($_FILES['topic_file']['size'] > 524288) {
		$message  = '<b>Error:</b> Image (Max.: 512 k.byte)<p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	}
	$picture_1_tmp_name = $_FILES['topic_file']['tmp_name']; 
	$picture_1_new_name = $_FILES['topic_file']['name']; 
	$picture_1_clean_name = substr($picture_1_new_name, -4);
	$picture_1_date = randomkeys(10);
	$picture_1 = $picture_1_date . $picture_1_clean_name;
	if (in_array($_FILES['topic_file']['type'], $types)) {
		move_uploaded_file($picture_1_tmp_name, $fullpath . $picture_1);
		$sorgu = mysql_query(sprintf("UPDATE `ts_topic` SET `topic_file` = '%s' WHERE `topic_id` = '%s';", $picture_1, $event_id));
	} else {
		$message  = '<b>Error:</b> Extension fail for Image!';
		die($message);
	}
}
?>