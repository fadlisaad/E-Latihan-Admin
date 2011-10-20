<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);

$start_date1 = '2010-01-01';
$end_date1   = '2010-01-31';

$query_jan = "SELECT COUNT(id) AS jan FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date1."' AND '".$end_date1."'";
$jan  = mysql_query($query_jan , $ts_kursus) or die(mysql_error());
$row_jan  = mysql_fetch_assoc($jan);
$totalRows_jan  = mysql_num_rows($jan);

$start_date2 = '2010-02-01';
$end_date2   = '2010-02-29';

$query_feb = "SELECT COUNT(id) AS feb FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date2."' AND '".$end_date2."'";
$feb  = mysql_query($query_feb , $ts_kursus) or die(mysql_error());
$row_feb  = mysql_fetch_assoc($feb);
$totalRows_feb  = mysql_num_rows($feb);

$start_date3 = '2010-03-01';
$end_date3   = '2010-03-31';

$query_mac = "SELECT COUNT(id) AS mac FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date3."' AND '".$end_date3."'";
$mac  = mysql_query($query_mac , $ts_kursus) or die(mysql_error());
$row_mac  = mysql_fetch_assoc($mac);
$totalRows_mac  = mysql_num_rows($mac);

$start_date4 = '2010-04-01';
$end_date4   = '2010-04-31';

$query_apr = "SELECT COUNT(id) AS apr FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date4."' AND '".$end_date4."'";
$apr  = mysql_query($query_apr , $ts_kursus) or die(mysql_error());
$row_apr  = mysql_fetch_assoc($apr);
$totalRows_apr  = mysql_num_rows($apr);

$start_date5 = '2010-05-01';
$end_date5   = '2010-05-31';

$query_mei = "SELECT COUNT(id) AS mei FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date5."' AND '".$end_date5."'";
$mei  = mysql_query($query_mei , $ts_kursus) or die(mysql_error());
$row_mei  = mysql_fetch_assoc($mei);
$totalRows_mei  = mysql_num_rows($mei);

$start_date6 = '2010-06-01';
$end_date6   = '2010-06-31';

$query_jun = "SELECT COUNT(id) AS jun FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date6."' AND '".$end_date6."'";
$jun  = mysql_query($query_jun , $ts_kursus) or die(mysql_error());
$row_jun  = mysql_fetch_assoc($jun);
$totalRows_jun  = mysql_num_rows($jun);

$start_date7 = '2010-07-01';
$end_date7  = '2010-07-31';

$query_jul = "SELECT COUNT(id) AS jul FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date7."' AND '".$end_date7."'";
$jul  = mysql_query($query_jul , $ts_kursus) or die(mysql_error());
$row_jul  = mysql_fetch_assoc($jul);
$totalRows_jul  = mysql_num_rows($jul);

$start_date8 = '2010-08-01';
$end_date8   = '2010-08-31';

$query_ogo = "SELECT COUNT(id) AS ogo FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date8."' AND '".$end_date8."'";
$ogo  = mysql_query($query_ogo , $ts_kursus) or die(mysql_error());
$row_ogo  = mysql_fetch_assoc($ogo);
$totalRows_ogo  = mysql_num_rows($ogo);

$start_date9 = '2010-09-01';
$end_date9   = '2010-09-31';

$query_sep = "SELECT COUNT(id) AS sep FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date9."' AND '".$end_date9."'";
$sep  = mysql_query($query_sep , $ts_kursus) or die(mysql_error());
$row_sep  = mysql_fetch_assoc($sep);
$totalRows_sep  = mysql_num_rows($sep);

$start_date10 = '2010-10-01';
$end_date10  = '2010-10-31';

$query_okt = "SELECT COUNT(id) AS okt FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date10."' AND '".$end_date10."'";
$okt  = mysql_query($query_okt , $ts_kursus) or die(mysql_error());
$row_okt  = mysql_fetch_assoc($okt);
$totalRows_okt  = mysql_num_rows($okt);

$start_date11 = '2010-11-01';
$end_date11   = '2010-11-31';

$query_nov = "SELECT COUNT(id) AS nov FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date11."' AND '".$end_date11."'";
$nov  = mysql_query($query_nov , $ts_kursus) or die(mysql_error());
$row_nov  = mysql_fetch_assoc($nov);
$totalRows_nov  = mysql_num_rows($nov);

$start_date12 = '2010-12-01';
$end_date12   = '2010-12-31';

$query_dis = "SELECT COUNT(id) AS dis FROM ts_invoice WHERE lastupdate BETWEEN '".$start_date12."' AND '".$end_date12."'";
$dis  = mysql_query($query_dis , $ts_kursus) or die(mysql_error());
$row_dis  = mysql_fetch_assoc($dis);
$totalRows_dis  = mysql_num_rows($dis);

// echo xml start here
echo "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n";
echo "<chart>\n";
	echo "<series>\n";
		echo "<value xid=\"0\">Jan</value>\n";
		echo "<value xid=\"1\">Feb</value>\n";
		echo "<value xid=\"2\">Mac</value>\n";
		echo "<value xid=\"3\">Apr</value>\n";
		echo "<value xid=\"4\">Mei</value>\n";
		echo "<value xid=\"5\">Jun</value>\n";
		echo "<value xid=\"6\">Jul</value>\n";
		echo "<value xid=\"7\">Ogo</value>\n";
		echo "<value xid=\"8\">Sept</value>\n";
		echo "<value xid=\"9\">Okt</value>\n";
		echo "<value xid=\"10\">Nov</value>\n";
		echo "<value xid=\"11\">Dis</value>\n";
	echo "</series>\n";
	echo "<graphs>\n";
		echo "<graph gid=\"1\">\n";
    		echo "<value xid=\"0\" color=\"FF0F00\">".$row_jan['jan']."</value>\n";
    		echo "<value xid=\"1\" color=\"FF6600\">".$row_feb['feb']."</value>\n";
    		echo "<value xid=\"2\" color=\"FF9E01\">".$row_mac['mac']."</value>\n";
    		echo "<value xid=\"3\" color=\"FCD202\">".$row_apr['apr']."</value>\n";
    		echo "<value xid=\"4\" color=\"F8FF01\">".$row_mei['mei']."</value>\n";
    		echo "<value xid=\"5\" color=\"B0DE09\">".$row_jun['jun']."</value>\n";
    		echo "<value xid=\"6\" color=\"F8FF01\">".$row_jul['jul']."</value>\n";
    		echo "<value xid=\"7\" color=\"F8FF01\">".$row_ogo['ogo']."</value>\n";
    		echo "<value xid=\"8\" color=\"FCD202\">".$row_sep['sep']."</value>\n";
    		echo "<value xid=\"9\" color=\"FF9E01\">".$row_okt['okt']."</value>\n";
			echo "<value xid=\"10\" color=\"FF6600\">".$row_nov['nov']."</value>\n";
			echo "<value xid=\"11\" color=\"FF0F00\">".$row_dis['dis']."</value>\n";
      echo "</graph>\n";
	echo "</graphs>\n";
echo "</chart>\n";

mysql_free_result($jan);
mysql_free_result($feb);
mysql_free_result($mac);
mysql_free_result($apr);
mysql_free_result($mei);
mysql_free_result($jun);
mysql_free_result($jul);
mysql_free_result($ogo);
mysql_free_result($sep);
mysql_free_result($okt);
mysql_free_result($nov);
mysql_free_result($dis);
?>
