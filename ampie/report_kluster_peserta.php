<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);

$query_ternakan = "SELECT COUNT(peserta_id) AS peserta1, ts_kursus.ts_kursus_kategori FROM ts_invoice, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_invoice.kursus_id AND ts_kursus.ts_kursus_kategori='Teknologi Ternakan' GROUP BY ts_kursus.ts_kursus_kategori";
$ternakan = mysql_query($query_ternakan, $ts_kursus) or die(mysql_error());
$row_ternakan = mysql_fetch_assoc($ternakan);
$totalRows_ternakan = mysql_num_rows($ternakan);

$query_tanaman = "SELECT COUNT(peserta_id) AS peserta2, ts_kursus.ts_kursus_kategori FROM ts_invoice, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_invoice.kursus_id AND ts_kursus.ts_kursus_kategori='Teknologi Tanaman' GROUP BY ts_kursus.ts_kursus_kategori";
$tanaman = mysql_query($query_tanaman, $ts_kursus) or die(mysql_error());
$row_tanaman = mysql_fetch_assoc($tanaman);
$totalRows_tanaman = mysql_num_rows($tanaman);

$query_makanan = "SELECT COUNT(peserta_id) AS peserta3, ts_kursus.ts_kursus_kategori FROM ts_invoice, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_invoice.kursus_id AND ts_kursus.ts_kursus_kategori='Teknologi Makanan' GROUP BY ts_kursus.ts_kursus_kategori";
$makanan = mysql_query($query_makanan, $ts_kursus) or die(mysql_error());
$row_makanan = mysql_fetch_assoc($makanan);
$totalRows_makanan = mysql_num_rows($makanan);

$query_lanjutan = "SELECT COUNT(peserta_id) AS peserta4, ts_kursus.ts_kursus_kategori FROM ts_invoice, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_invoice.kursus_id AND ts_kursus.ts_kursus_kategori='Teknologi Lanjutan' GROUP BY ts_kursus.ts_kursus_kategori";
$lanjutan = mysql_query($query_lanjutan, $ts_kursus) or die(mysql_error());
$row_lanjutan = mysql_fetch_assoc($lanjutan);
$totalRows_lanjutan = mysql_num_rows($lanjutan); 


// echo xml start here
	echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
	echo "<pie>\n";
	echo "<slice title=\"Ternakan\">".$row_ternakan['peserta1']."</slice>\n";
	echo "<slice title=\"Tanaman\">".$row_tanaman['peserta2']."</slice>\n";
	echo "<slice title=\"Makanan\">".$row_makanan['peserta3']."</slice>\n";
	echo "<slice title=\"Lanjutan\">".$row_lanjutan['peserta4']."</slice>\n";
	echo "</pie>";
	mysql_free_result($ternakan);
?>
