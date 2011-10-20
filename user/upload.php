<?php require_once('../Connections/ts_kursus.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_upload = "-1";
if (isset($_GET['ts_peserta_ID'])) {
  $colname_upload = $_GET['ts_peserta_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_upload = sprintf("SELECT ts_peserta_ID FROM ts_peserta WHERE ts_peserta_ID = %s", GetSQLValueString($colname_upload, "int"));
$upload = mysql_query($query_upload, $ts_kursus) or die(mysql_error());
$row_upload = mysql_fetch_assoc($upload);
$totalRows_upload = mysql_num_rows($upload);
?><link href="../css/main.css" rel="stylesheet" type="text/css" />
<div id="content">
    <form method="post" enctype="multipart/form-data">
    <table class="nostyle">
    <tr>
    <td>
    <input type="hidden" name="MAX_FILE_SIZE" value="200000000">
    <input name="userfile" type="file" class="input-text" id="userfile">    </td>
    </tr>
    <tr>
      <td><input name="upload" type="submit" class="buttons" id="upload" value=" Upload " /></td>
      </tr>
    </table>
    <input name="files_id" type="hidden" id="files_id" value="<?php echo $_GET['ts_kursus_id']; ?>" />
</form>

<?php
	if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
	{
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];
		
		$fp      = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);
		
		if(!get_magic_quotes_gpc())
		{
			$fileName = addslashes($fileName);
		}
	
	$query = "INSERT INTO ts_pictures (files_id, name, size, type, content)".
	"VALUES ( '".$_GET['ts_peserta_ID']."', '".$fileName."', '".$fileSize."', '".$fileType."', '".$content."')";
	
	mysql_query($query)or trigger_error(mysql_error(),E_USER_ERROR);
	
	echo "<p class='msg info'>Fail $fileName telah dimuat-naik. <a href='javascript:window.close();'>Tutup</a><p>";
	echo "</div>";
	}
	

mysql_free_result($upload);
?>