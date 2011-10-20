<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_popular = "SELECT ts_peserta.ts_peserta_status, ts_kursus.ts_kursus_id,COUNT(ts_peserta_status), ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_bil_max FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status GROUP BY ts_peserta_status ORDER BY COUNT(ts_peserta_status) DESC";
$popular = mysql_query($query_popular, $ts_kursus) or die(mysql_error());
$row_popular = mysql_fetch_assoc($popular);
$totalRows_popular = mysql_num_rows($popular);

// echo xml start here
	echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
	echo "
	<pie>\n";
	  
	  //data start here
	  do {
	  	echo "<slice title=\"".$row_popular['ts_kursus_nama']."\">";
	    echo $row_popular['COUNT(ts_peserta_status)'];
	    echo "</slice>
	  \n";
	  } while ($row_popular = mysql_fetch_assoc($popular));
	  echo "</pie>
	";
mysql_free_result($popular);
?>
