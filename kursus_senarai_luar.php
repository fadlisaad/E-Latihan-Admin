<?php
error_reporting(0);
require_once('Connections/ts.php'); 
//$today_date = date('Y-m-d');

mysql_select_db($database_ts, $ts);
$query_pertanian = "SELECT * FROM ts_kursus WHERE ts_kursus_kategori = 'Teknologi Tanaman' AND ts_kursus_publish_status = '1' AND ts_kursus_vendor = 'Kursus Luar Jadual' ORDER BY ts_kursus_tarikh_mula DESC";
$pertanian = mysql_query($query_pertanian, $ts) or die(mysql_error());
$row_pertanian = mysql_fetch_assoc($pertanian);
$totalRows_pertanian = mysql_num_rows($pertanian);

mysql_select_db($database_ts, $ts);
$query_teknologi_makanan = "SELECT * FROM ts_kursus WHERE ts_kursus_kategori = 'Teknologi Makanan' AND ts_kursus_publish_status = '1' AND ts_kursus_vendor = 'Kursus Luar Jadual' ORDER BY ts_kursus_tarikh_mula DESC";
$teknologi_makanan = mysql_query($query_teknologi_makanan, $ts) or die(mysql_error());
$row_teknologi_makanan = mysql_fetch_assoc($teknologi_makanan);
$totalRows_teknologi_makanan = mysql_num_rows($teknologi_makanan);

mysql_select_db($database_ts, $ts);
$query_proses = "SELECT * FROM ts_kursus WHERE ts_kursus_kategori = 'Teknologi Lanjutan' AND ts_kursus_publish_status = '1' AND ts_kursus_vendor = 'Kursus Luar Jadual' ORDER BY ts_kursus_tarikh_mula DESC";
$proses = mysql_query($query_proses, $ts) or die(mysql_error());
$row_proses = mysql_fetch_assoc($proses);
$totalRows_proses = mysql_num_rows($proses);

mysql_select_db($database_ts, $ts);
$query_penternakan = "SELECT * FROM ts_kursus WHERE ts_kursus_kategori = 'Teknologi Ternakan' AND ts_kursus_publish_status = '1' AND ts_kursus_vendor = 'Kursus Luar Jadual' ORDER BY ts_kursus_tarikh_mula DESC";
$penternakan = mysql_query($query_penternakan, $ts) or die(mysql_error());
$row_penternakan = mysql_fetch_assoc($penternakan);
$totalRows_penternakan = mysql_num_rows($penternakan);

isset($startRow_pertanian)? $orderNum=$startRow_pertanian:$orderNum=0;
isset($startRow_teknologi_makanan)? $orderNum1=$startRow_teknologi_makanan:$orderNum1=0;
isset($startRow_proses)? $orderNum2=$startRow_proses:$orderNum2=0;
isset($startRow_penternakan)? $orderNum3=$startRow_penternakan:$orderNum3=0;

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
<h3>Senarai Kursus Luar Jadual yang ditawarkan bagi tahun 2010</h3>
<p>Berikut adalah senarai kursus yang telah disediakan bagi sepanjang tahun 2010. Anda boleh mendaftar secara dalam talian sekarang. Tarikh dan tempat kursus akan diberitahu kelak.</p>
<div class="legend-hilite">
<h3 class="legend-title">Teknologi Tanaman</h3>
<?php if ($totalRows_pertanian == 0) { // Show if recordset empty ?>
<p class="message"><span class="icon">&nbsp;</span>Tiada Kursus ditawarkan</p>
<?php } // Show if recordset empty ?>
<?php if ($totalRows_pertanian > 0) { // Show if recordset not empty ?>
<p>
  <table width="100%" class="weblinks">
    <thead class="sectiontableheader">
      <tr>
        <th>Bil</th>
        <th>Kod</th>
        <th>Tajuk</th>
        <th>Yuran</th>
        <th>Lokasi</th>
        <th>Mohon</th>
      </tr>
      </thead>
      <tbody>
      <?php do { ?>
        <tr valign="top">
          <td><?php echo ++$orderNum; ?></td>
          <td><?php echo $row_pertanian['ts_kursus_kod']; ?></td>
          <td><?php echo strtoupper($row_pertanian['ts_kursus_nama']); ?></td>
          <td width="30" nowrap="nowrap">RM <?php echo $row_pertanian['ts_kursus_harga']; ?></td>
          <td width="30" nowrap="nowrap"><?php echo strtoupper($row_pertanian['ts_kursus_lokasi']); ?></td>
          <td width="20"><div align="center"><a href="index.php?option=com_jumi&amp;fileid=24&amp;ts_kursus_id=<?php echo $row_pertanian['ts_kursus_id']; ?>"><img src="ts/images/icons/accept.png" alt="Pohon" width="24" height="24"></a></div></td>
        </tr>
        <?php } while ($row_pertanian = mysql_fetch_assoc($pertanian)); ?>
        </tbody>
    </table>
</p><?php } // Show if recordset not empty ?>
</div>
<div class="legend-hilite">
  <h3 class="legend-title">Teknologi Ternakan</h3>
  <?php if ($totalRows_penternakan == 0) { // Show if recordset empty ?>
  <p class="message"><span class="icon">&nbsp;</span>Tiada Kursus ditawarkan</p>
  <?php } // Show if recordset empty ?>
  <?php if ($totalRows_penternakan > 0) { // Show if recordset not empty ?>
  <p>&nbsp;</p>
  <table width="100%" class="weblinks">
    <thead class="sectiontableheader">
      <tr>
        <th>Bil</th>
        <th>Kod</th>
        <th>Tajuk</th>
        <th>Yuran</th>
        <th>Lokasi</th>
        <th>Mohon</th>
      </tr>
    </thead>
    <tbody>
      <?php do { ?>
      <tr valign="top">
        <td><?php echo ++$orderNum1; ?></td>
        <td><?php echo $row_penternakan['ts_kursus_kod']; ?></td>
        <td><?php echo strtoupper($row_penternakan['ts_kursus_nama']); ?></td>
        <td width="30">RM <?php echo $row_penternakan['ts_kursus_harga']; ?></td>
        <td width="30"><?php echo strtoupper($row_penternakan['ts_kursus_lokasi']); ?></td>
        <td width="20"><div align="center"><a href="index.php?option=com_jumi&amp;fileid=24&amp;ts_kursus_id=<?php echo $row_penternakan['ts_kursus_id']; ?>"><img src="ts/images/icons/accept.png" alt="Pohon" width="24" height="24" /></a></div></td>
      </tr>
      <?php } while ($row_penternakan = mysql_fetch_assoc($penternakan)); ?>
    </tbody>
  </table>
  </p>
  <?php } // Show if recordset not empty ?>
</div>
<p>&nbsp;</p>
<div class="legend-hilite">
<h3 class="legend-title">Teknologi Makanan</h3>
<?php if ($totalRows_teknologi_makanan == 0) { // Show if recordset empty ?>
<p class="message"><span class="icon">&nbsp;</span>Tiada Kursus ditawarkan</p>
<?php } // Show if recordset empty ?>
<?php if ($totalRows_teknologi_makanan > 0) { // Show if recordset not empty ?>
<p>
  <table width="100%" class="weblinks">
    <thead class="sectiontableheader">
      <tr>
        <th>Bil</th>
        <th>Kod</th>
        <th>Tajuk</th>
        <th>Yuran</th>
        <th>Lokasi</th>
        <th>Mohon</th>
      </tr>
    </thead>
    <tbody>
      <?php do { ?>
        <tr valign="top">
          <td><?php echo ++$orderNum2; ?></td>
          <td><?php echo $row_teknologi_makanan['ts_kursus_kod']; ?></td>
          <td><?php echo strtoupper($row_teknologi_makanan['ts_kursus_nama']); ?></td>
          <td width="30">RM <?php echo $row_teknologi_makanan['ts_kursus_harga']; ?></td>
          <td width="30"><?php echo strtoupper($row_teknologi_makanan['ts_kursus_lokasi']); ?></td>
          <td width="20"><div align="center"><a href="index.php?option=com_jumi&amp;fileid=24&amp;ts_kursus_id=<?php echo $row_teknologi_makanan['ts_kursus_id']; ?>"><img src="ts/images/icons/accept.png" alt="Pohon" width="24" height="24"></a></div></td>
        </tr>
        <?php } while ($row_teknologi_makanan = mysql_fetch_assoc($teknologi_makanan)); ?>
</tbody>
  </table>
</p><?php } // Show if recordset not empty ?>
</div>
<div class="legend-hilite">
<h3 class="legend-title">Teknologi Lanjutan</h3>
<?php if ($totalRows_proses == 0) { // Show if recordset empty ?>
<p class="message"><span class="icon">&nbsp;</span>Tiada Kursus ditawarkan</p>
<?php } // Show if recordset empty ?>
<?php if ($totalRows_proses > 0) { // Show if recordset not empty ?>
<p><table width="100%" class="weblinks">
      <thead class="sectiontableheader">
      <tr>
        <th>Bil</th>
        <th>Kod</th>
        <th>Tajuk</th>
        <th>Yuran</th>
        <th>Lokasi</th>
        <th>Mohon</th>
      </tr>
      </thead>
      <tbody>
        <?php do { ?>
        <tr valign="top">
          <td><?php echo ++$orderNum3; ?></td>
          <td><?php echo $row_proses['ts_kursus_kod']; ?></td>
          <td><?php echo strtoupper($row_proses['ts_kursus_nama']); ?></td>
          <td width="30">RM <?php echo $row_proses['ts_kursus_harga']; ?></td>
          <td width="30"><?php echo strtoupper($row_proses['ts_kursus_lokasi']); ?></td>
          <td width="20"><div align="center"><a href="index.php?option=com_jumi&amp;fileid=24&amp;ts_kursus_id=<?php echo $row_proses['ts_kursus_id']; ?>"><img src="ts/images/icons/accept.png" alt="Pohon" width="24" height="24"></a></div></td>
        </tr>
          <?php } while ($row_proses = mysql_fetch_assoc($proses)); ?>
</tbody>
    </table>
</p><?php } // Show if recordset not empty ?>
</div>
<?php
mysql_free_result($pertanian);
mysql_free_result($teknologi_makanan);
mysql_free_result($penternakan);
mysql_free_result($proses);
?>