<?php require_once('Connections/ts_kursus.php'); ?>
<?php
error_reporting(E_ALL);
$colname_kursus_keterangan = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_kursus_keterangan = $_GET['ts_kursus_id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_keterangan = sprintf("SELECT * FROM ts_kursus WHERE ts_kursus_id = %s",$colname_kursus_keterangan, "int");
$kursus_keterangan = mysql_query($query_kursus_keterangan, $ts_kursus) or die(mysql_error());
$row_kursus_keterangan = mysql_fetch_assoc($kursus_keterangan);
$totalRows_kursus_keterangan = mysql_num_rows($kursus_keterangan);

$colname_peta = "-1";
if (isset($_GET['ts_tempat_ID'])) {
  $colname_peta = (get_magic_quotes_gpc()) ? $_GET['ts_tempat_ID'] : addslashes($_GET['ts_tempat_ID']);
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_peta = sprintf("SELECT ts_tempat_ID, ts_tempat_peta FROM ts_tempat_kursus WHERE ts_tempat_ID = %s LIMIT 1", $colname_peta, "int");
$peta = mysql_query($query_peta, $ts_kursus) or die(mysql_error());
$row_peta = mysql_fetch_assoc($peta);
$totalRows_peta = mysql_num_rows($peta);

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
?>
<h3>Tajuk Kursus: <?php echo $row_kursus_keterangan['ts_kursus_nama']; ?></h3>
    <form action="ts/login-user/login-check.php?ts_kursus_id=<?php echo $row_kursus_keterangan['ts_kursus_id']; ?>" method="POST" name="kursus_keterangan_form" id="kursus_keterangan_form">
      <table class="sortable" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="15%" align="left" valign="top" nowrap="nowrap" scope="row"><strong>Kod</strong></td>
          <td width="1%" align="left" valign="top" nowrap="nowrap" scope="row">:</td>
          <td align="left" valign="top" nowrap="nowrap" scope="row"><?php echo $row_kursus_keterangan['ts_kursus_kod']; ?></td>
        </tr>
        <tr class="roweven">
          <td width="15%" align="left" valign="top" scope="row"><strong>Kategori</strong></td>
          <td width="1%" align="left" valign="top" scope="row">:</td>
          <td align="left" valign="top" scope="row"><?php echo strtoupper($row_kursus_keterangan['ts_kursus_kategori']); ?><br /></td>
        </tr>
        <tr>
          <td width="15%" align="left" valign="top" scope="row"><strong>Sinopsis</strong></td>
          <td width="1%" align="left" valign="top" scope="row">:</td>
          <td align="left" valign="top" scope="row"><?php echo $row_kursus_keterangan['ts_kursus_keterangan']; ?><br /></td>
        </tr>
        <tr>
          <td width="15%" align="left" valign="top" nowrap="nowrap" scope="row"><strong>Lokasi</strong></td>
          <td width="1%" align="left" valign="top" nowrap="nowrap" scope="row">:</td>
          <td align="left" valign="top" nowrap="nowrap" scope="row"><?php echo strtoupper($row_kursus_keterangan['ts_kursus_lokasi']); ?></td>
        </tr>
        <tr>
          <td width="15%" align="left" valign="top" nowrap="nowrap" scope="row"><strong>Jenis</strong></td>
          <td width="1%" align="left" valign="top" nowrap="nowrap" scope="row">:</td>
          <td align="left" valign="top" nowrap="nowrap" scope="row"><?php echo strtoupper($row_kursus_keterangan['ts_kursus_vendor']); ?></td>
        </tr>
        <tr>
          <td width="15%" align="left" valign="top" nowrap="nowrap" scope="row"><input name="kursus_id" type="hidden" id="kursus_id" value="<?php echo $row_kursus_keterangan['ts_kursus_id']; ?>" /><?php echo $row_kursus_keterangan['ts_kursus_id']; ?></td>
          <td width="1%" align="left" valign="top" nowrap="nowrap" scope="row">&nbsp;</td>
          <td align="left" valign="top" nowrap="nowrap" scope="row"><input name="daftar" type="submit" class="button" id="daftar" onClick="MM_goToURL('parent','ts/login-user/login-check.php?ts_kursus_id=<?php echo $row_kursus_keterangan['ts_kursus_id']; ?>');return document.MM_returnValue" value="Daftar"/></td>
        </tr>
      </table> 
</form>

<?php
mysql_free_result($kursus_keterangan);
mysql_free_result($peta);
?>