<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);

$query_lelaki = "SELECT COUNT(ts_peserta_ID) AS peserta1 FROM ts_peserta WHERE ts_peserta.ts_peserta_jantina='lelaki'";
$lelaki = mysql_query($query_lelaki, $ts_kursus) or die(mysql_error());
$row_lelaki = mysql_fetch_assoc($lelaki);
$totalRows_lelaki = mysql_num_rows($lelaki);

$query_perempuan = "SELECT COUNT(ts_peserta_ID) AS peserta2 FROM ts_peserta WHERE ts_peserta.ts_peserta_jantina='perempuan'";
$perempuan = mysql_query($query_perempuan, $ts_kursus) or die(mysql_error());
$row_perempuan = mysql_fetch_assoc($perempuan);
$totalRows_perempuan = mysql_num_rows($perempuan);

// echo xml start here
	echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
	echo "<pie>\n";
	echo "<slice title=\"Lelaki\">".$row_lelaki['peserta1']."</slice>\n";
	echo "<slice title=\"Perempuan\">".$row_perempuan['peserta2']."</slice>\n";
	echo "</pie>";
	mysql_free_result($lelaki);
	mysql_free_result($perempuan);
?>