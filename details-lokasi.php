<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Details of location of course to be held.
 */
	error_reporting(0);
	require_once('Connections/ts_kursus.php'); 

$colname_lokasi_detail = "-1";
if (isset($_GET['ts_tempat_ID'])) {
  $colname_lokasi_detail = (get_magic_quotes_gpc()) ? $_GET['ts_tempat_ID'] : addslashes($_GET['ts_tempat_ID']);
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_lokasi_detail = sprintf("SELECT * FROM ts_tempat_kursus WHERE ts_tempat_ID = %s", $colname_lokasi_detail);
$lokasi_detail = mysql_query($query_lokasi_detail, $ts_kursus) or die(mysql_error());
$row_lokasi_detail = mysql_fetch_assoc($lokasi_detail);
$totalRows_lokasi_detail = mysql_num_rows($lokasi_detail);
?>
<h3>Keterangan Lokasi : <?php echo $row_lokasi_detail['ts_tempat_nama']; ?></h3>
<div class="legend-hilite">
<p><table width="100%" border="0" cellspacing="0" cellpadding="0" class="weblinks">
                      <tr>
                        <th class="a-right" width="20%">Nama stesen:</th>
                        <td><?php echo $row_lokasi_detail['ts_tempat_nama']; ?></td>
                      </tr>
                      <tr>
                        <th class="a-right">Alamat stesen:</th>
                        <td><?php echo $row_lokasi_detail['ts_tempat_alamat']; ?></td>
                      </tr>
                      <tr>
                        <th valign="top" class="a-right">Peta :</th>
                        <td><?php echo $row_lokasi_detail['ts_tempat_peta']; ?></td>
						</tr></p>
                    </table>
					</div>
<?php
mysql_free_result($lokasi_detail);
?>
