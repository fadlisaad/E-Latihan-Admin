<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);

$query_pekerjaan = "SELECT COUNT(ts_peserta_ID) AS perusahaan, ts_peserta_perusahaan FROM ts_peserta GROUP BY ts_peserta_perusahaan";
$pekerjaan = mysql_query($query_pekerjaan, $ts_kursus) or die(mysql_error());
$row_pekerjaan = mysql_fetch_assoc($pekerjaan);
$totalRows_pekerjaan = mysql_num_rows($pekerjaan);

// echo xml start here
	echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
	echo "<pie>\n";
	do {
	echo "<slice title=\"";
	echo strtoupper($row_pekerjaan['ts_peserta_perusahaan']);
	echo "\">".$row_pekerjaan['perusahaan']."</slice>\n";
	} while ($row_pekerjaan = mysql_fetch_assoc($pekerjaan));
	echo "</pie>";
	mysql_free_result($pekerjaan);
?>