<?php virtual('/elatihan/ts/Connections/ts_kursus.php'); ?>
<?php
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

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kluster = "SELECT ts_kursus.ts_kursus_kategori, COUNT(ts_kursus.ts_kursus_kategori) AS jumlah FROM ts_kursus GROUP BY ts_kursus.ts_kursus_kategori";
$kluster = mysql_query($query_kluster, $ts_kursus) or die(mysql_error());
$row_kluster = mysql_fetch_assoc($kluster);
$totalRows_kluster = mysql_num_rows($kluster);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Jumlah Kursus Mengikut Kluster</title>
		
		
		<!-- 1. Add these JavaScript inclusions in the head of your page -->
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/highcharts.js"></script>
		<!--[if IE]>
			<script type="text/javascript" src="../js/excanvas.compiled.js"></script>
		<![endif]-->
		
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script type="text/javascript">
		$(document).ready(function() {
			var chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					defaultSeriesType: 'column'
				},
				title: {
					text: 'Jumlah Kursus mengikut Kluster'
				},
				subtitle: {
					text: 'Sumber: e-Latihan, MARDI'
				},
				xAxis: {
					categories: [
						'Jan', 
						'Feb', 
						'Mac', 
						'Apr', 
						'Mei', 
						'Jun', 
						'Jul', 
						'Ogo', 
						'Sep', 
						'Okt', 
						'Nov', 
						'Dis'
					]
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Jumlah kursus'
					}
				},
				legend: {
					layout: 'vertical',
					backgroundColor: '#FFFFFF',
					style: {
						left: '100px',
						top: '70px',
						bottom: 'auto'
					}
				},
				tooltip: {
					formatter: function() {
						return '<b>'+ this.series.name +'</b><br/>'+
							this.x +': '+ this.y +' kursus';
					}
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
			        series: [{
					name: 'Teknologi Tanaman',
					data: [<?php do { ?>
					<?php echo $row_kluster['jumlah']; ?>,
					<?php } while ($row_kluster = mysql_fetch_assoc($kluster)); ?>]
			
				}, {
					name: 'Teknologi Ternakan',
					data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
			
				}, {
					name: 'Teknologi Makanan',
					data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
			
				}, {
					name: 'Teknologi Lanjutan',
					data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
			
				}]
			});
			
			
		});
		</script>
		
	</head>
	<body>
		
		<!-- 3. Add the container -->
		<div id="container" style="width: 800px; height: 400px"></div>
		
				
	</body>
</html>
<?php
mysql_free_result($kluster);
?>
