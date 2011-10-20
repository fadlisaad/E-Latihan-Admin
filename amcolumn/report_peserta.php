<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_popular = "SELECT ts_peserta.ts_peserta_status, ts_kursus.ts_kursus_id,COUNT(ts_peserta_status), ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_bil_max FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status GROUP BY ts_peserta_status ORDER BY COUNT(ts_peserta_status) DESC";
$popular = mysql_query($query_popular, $ts_kursus) or die(mysql_error());
$row_popular = mysql_fetch_assoc($popular);
$totalRows_popular = mysql_num_rows($popular);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_data = "SELECT ts_peserta.ts_peserta_status, ts_kursus.ts_kursus_id,COUNT(ts_peserta_status), ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_bil_max FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status GROUP BY ts_peserta_status ORDER BY COUNT(ts_peserta_status) DESC";
$data = mysql_query($query_data, $ts_kursus) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kuota = "SELECT ts_peserta.ts_peserta_status, ts_kursus.ts_kursus_id,COUNT(ts_peserta_status), ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_bil_max FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status GROUP BY ts_peserta_status ORDER BY COUNT(ts_peserta_status) DESC";
$kuota = mysql_query($query_kuota, $ts_kursus) or die(mysql_error());
$row_kuota = mysql_fetch_assoc($kuota);
$totalRows_kuota = mysql_num_rows($kuota);

$num=0;
$num1=0;
$num2=0;
// echo xml start here
	echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
	echo "<chart>\n";
	
 	echo "<series>\n";
 	//data start here
		do {
  		echo "<value xid=\"".$num++."\">".$row_popular['ts_kursus_nama']."</value>\n";
  			} while ($row_popular = mysql_fetch_assoc($popular));
 	echo "</series>\n";
	
 	echo "<graphs>\n";
	
  	echo "<graph gid=\"1\">\n";
	//data start here
		do {
		echo "<value xid=\"".$num1++."\">".$row_data['COUNT(ts_peserta_status)']."</value>\n";
			} while ($row_data = mysql_fetch_assoc($data));
	echo "</graph>\n";
	
	echo "<graph gid=\"2\">\n";
	//data start here
		do {
	echo "<value xid=\"".$num2++."\">".$row_kuota['ts_kursus_bil_max']."</value>\n";
			} while ($row_kuota = mysql_fetch_assoc($kuota));
	echo "</graph>\n";
	
 	echo "</graphs>\n";
	echo "</chart>\n";
mysql_free_result($popular);
mysql_free_result($data);
mysql_free_result($kuota);
?>