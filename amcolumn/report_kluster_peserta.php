<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);

$query_kursus = "SELECT ts_kursus.ts_kursus_kategori,COUNT(ts_kursus_id) AS jumlah FROM ts_kursus GROUP BY ts_kursus.ts_kursus_kategori";
$kursus = mysql_query($query_kursus, $ts_kursus) or die(mysql_error());
$row_kursus = mysql_fetch_assoc($kursus);
$totalRows_kursus = mysql_num_rows($kursus);

$query_data = "SELECT ts_kursus.ts_kursus_kategori,COUNT(ts_kursus_id) AS jumlah FROM ts_kursus GROUP BY ts_kursus.ts_kursus_kategori";
$data = mysql_query($query_data, $ts_kursus) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

$num=0;$num1=0;
// echo xml start here
	echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
	echo "<chart>\n";	
 	echo "<series>\n";
 	//data start here
		do {
  		echo "<value xid=\"".$num++."\">".$row_kursus['ts_kursus_kategori']."</value>\n";
  			} while ($row_kursus = mysql_fetch_assoc($kursus));
 	echo "</series>\n";
 	echo "<graphs>\n";
	
  	echo "<graph gid=\"1\">\n";
	//data start here
		do {
		echo "<value xid=\"".$num1++."\">".$row_data['jumlah']."</value>\n";
			} while ($row_data = mysql_fetch_assoc($data));
	echo "</graph>\n";
		
 	echo "</graphs>\n";
	echo "</chart>\n";
	
	mysql_free_result($kursus);
	mysql_free_result($data);
?>
