<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Location Listing.
 */
	error_reporting(0);
?>
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

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_lokasi_senarai = "SELECT * FROM ts_tempat_kursus ORDER BY ts_tempat_kursus.ts_tempat_nama ASC";
$lokasi_senarai = mysql_query($query_lokasi_senarai, $ts_kursus) or die(mysql_error());
$row_lokasi_senarai = mysql_fetch_assoc($lokasi_senarai);
$totalRows_lokasi_senarai = mysql_num_rows($lokasi_senarai);

isset($startRow_lokasi_senarai)? $orderNum=$startRow_lokasi_senarai:$orderNum=0;
?>
<div class="legend-hilite">
<h3 class="legend-title">Senarai Lokasi</h3>
<p>
                <table width="100%" class="weblinks">
                  <thead class="sectiontableheader">
                    <tr>
                      <th width="40">Bil</th>
                      <th>Lokasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                    <tr>
                      <td class="a-center"><?php echo ++$orderNum; ?></td>
                      <td><a href="index.php?option=com_jumi&amp;fileid=15&amp;ts_tempat_ID=<?php echo $row_lokasi_senarai['ts_tempat_ID']; ?>"><?php echo $row_lokasi_senarai['ts_tempat_nama']; ?></a></td>
                    </tr>
                      <?php } while ($row_lokasi_senarai = mysql_fetch_assoc($lokasi_senarai)); ?>
                  </tbody>
                </table>
				</p>
				</div>
<?php
mysql_free_result($lokasi_senarai);
?>