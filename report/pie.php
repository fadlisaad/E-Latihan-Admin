<?php require_once('../Connections/ts_kursus.php'); 
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_popular = "SELECT ts_peserta.ts_peserta_status, ts_kursus.ts_kursus_id,COUNT(ts_peserta_status), ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_bil_max FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status GROUP BY ts_peserta_status ORDER BY COUNT(ts_peserta_status) DESC";
$popular = mysql_query($query_popular, $ts_kursus) or die(mysql_error());
$row_popular = mysql_fetch_assoc($popular);
$totalRows_popular = mysql_num_rows($popular);
?>	
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
					margin: [50, 200, 60, 170]
				},
				title: {
					text: 'Browser market shares at a specific website, 2008'
				},
				plotArea: {
					shadow: null,
					borderWidth: null,
					backgroundColor: null
				},
				tooltip: {
					formatter: function() {
						return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
					}
				},
				plotOptions: {
					pie: {
						dataLabels: {
							enabled: true,
							formatter: function() {
								if (this.y > 5) return this.point.name;
							},
							color: 'white',
							style: {
								font: '13px Trebuchet MS, Verdana, sans-serif'
							}
						}
					}
				},
				legend: {
					layout: 'vertical',
					style: {
						left: 'auto',
						bottom: 'auto',
						right: '50px',
						top: '100px'
					}
				},
			        series: [{
					type: 'pie',
					name: 'Browser share',
					data: [<?php do { ?>
					{
							name: '<?php echo $row_popular['ts_kursus_nama'] ?>',
							y: <?php echo $row_popular['COUNT(ts_peserta_status)'] ?>,
							sliced: false
						}
						 <?php } while ($row_popular = mysql_fetch_assoc($popular)); ?>
					]
				}]
			});
			
			
		});
		</script>
		<div id="container" style="width: 800px; height: 400px"></div>
        <?php mysql_free_result($popular); ?>