<?php
function dbInit(){
    mysql_connect("localhost", "root", "nazira") or die(mysql_error());
    mysql_select_db("data_ts") or die(mysql_error());
}

function handleUpload($index){
    if (isset($_FILES[$index])===false){
    return false;
    }
    
    $fileName = $_FILES[$index]['name'];
    $tmpName = $_FILES[$index]['tmp_name'];
    $fileSize = $_FILES[$index]['size'];
    $fileType = $_FILES[$index]['type'];
    
    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);
    
    if(!get_magic_quotes_gpc()){
        $fileName = addslashes($fileName);
    }
    
    if($fileSize>0){
        dbInit();
        $query = "INSERT INTO ts_files (files_id, name, type, size, content) VALUES (".$_GET['ts_kursus_id'].", ".$fileName.", ".$fileType.",".$fileSize.",".$content.")";

        mysql_query($query) or die('Error, query failed');
    
        echo "<br>File $fileName uploaded<br>";
        echo "<br> New File Created with data<br>";
		echo "<br>Fail $fileName telah dimuat-naik. <a href='javascript:window.close();'>Tutup</a><br>";
    }
}

header('Location: upload-kursus.php?ts_kursus_id='.$_GET['ts_kursus_id'].'');
?>