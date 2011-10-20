<?php require_once('../Connections/ts_kursus.php'); ?>
<?php
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_data = "SELECT ts_vendor.kursus_vendor_nama,COUNT(kursus_vendor_nama) FROM ts_vendor, ts_kursus WHERE ts_kursus.ts_kursus_vendor=ts_vendor.kursus_vendor_nama GROUP BY kursus_vendor_nama";
$data = mysql_query($query_data, $ts_kursus) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);
?>
<?php
// echo xml start here
	echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
	echo "
    <pie>\n";
      
      //data start here
      do { 
      		echo "<slice title=\"";
			echo $row_data['kursus_vendor_nama'];
			echo "\">";
          	echo $row_data['COUNT(kursus_vendor_nama)'];
          	echo "</slice>
      \n";
      } while ($row_data = mysql_fetch_assoc($data));
      echo "</pie>
";
mysql_free_result($data);
?>