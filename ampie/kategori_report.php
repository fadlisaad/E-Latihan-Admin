<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_count_kursus = "SELECT ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_kategori,COUNT(ts_kursus_id) FROM ts_kursus GROUP BY ts_kursus_kategori ORDER BY COUNT(ts_kursus_id) desc";
$count_kursus = mysql_query($query_count_kursus, $ts_kursus) or die(mysql_error());
$row_count_kursus = mysql_fetch_assoc($count_kursus);
$totalRows_count_kursus = mysql_num_rows($count_kursus);

// echo xml start here
	echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
	echo "
	<pie>\n";
	  
	  //data start here
	  do {
	  	echo "<slice title=\"$row_count_kursus[ts_kursus_kategori]\">";
	    echo $row_count_kursus['COUNT(ts_kursus_id)'];
	    echo "</slice>
	  \n";
	  } while ($row_count_kursus = mysql_fetch_assoc($count_kursus));
	  echo "</pie>
	";
mysql_free_result($count_kursus);
?>
