<?php require_once('../../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);

$query_ternakan = "SELECT COUNT(ts_peserta_status) AS peserta1, ts_kursus.ts_kursus_kategori FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status AND ts_kursus.ts_kursus_kategori='Teknologi Ternakan' GROUP BY ts_kursus.ts_kursus_kategori";
$ternakan = mysql_query($query_ternakan, $ts_kursus) or die(mysql_error());
$row_ternakan = mysql_fetch_assoc($ternakan);
$totalRows_ternakan = mysql_num_rows($ternakan);

$query_tanaman = "SELECT COUNT(ts_peserta_status) AS peserta2, ts_kursus.ts_kursus_kategori FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status AND ts_kursus.ts_kursus_kategori='Teknologi Tanaman' GROUP BY ts_kursus.ts_kursus_kategori";
$tanaman = mysql_query($query_tanaman, $ts_kursus) or die(mysql_error());
$row_tanaman = mysql_fetch_assoc($tanaman);
$totalRows_tanaman = mysql_num_rows($tanaman);

$query_makanan = "SELECT COUNT(ts_peserta_status) AS peserta3, ts_kursus.ts_kursus_kategori FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status AND ts_kursus.ts_kursus_kategori='Teknologi Makanan' GROUP BY ts_kursus.ts_kursus_kategori";
$makanan = mysql_query($query_makanan, $ts_kursus) or die(mysql_error());
$row_makanan = mysql_fetch_assoc($makanan);
$totalRows_makanan = mysql_num_rows($makanan);

$query_lanjutan = "SELECT COUNT(ts_peserta_status) AS peserta4, ts_kursus.ts_kursus_kategori FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status AND ts_kursus.ts_kursus_kategori='Teknologi Lanjutan' GROUP BY ts_kursus.ts_kursus_kategori";
$lanjutan = mysql_query($query_lanjutan, $ts_kursus) or die(mysql_error());
$row_lanjutan = mysql_fetch_assoc($lanjutan);
$totalRows_lanjutan = mysql_num_rows($lanjutan); 

$query_kursus = "SELECT ts_kursus.ts_kursus_kategori,COUNT(ts_kursus_id) AS jumlah FROM ts_kursus GROUP BY ts_kursus.ts_kursus_kategori";
$kursus = mysql_query($query_kursus, $ts_kursus) or die(mysql_error());
$row_kursus = mysql_fetch_assoc($kursus);
$totalRows_kursus = mysql_num_rows($kursus);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!-- InstanceBegin template="/Templates/Admin_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="en" />
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/reset.css" />
<!-- RESET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/main.css" />
<!-- MAIN STYLE SHEET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/2col.css" title="2col" />
<!-- DEFAULT: 2 COLUMNS -->
<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../../css/1col.css" title="1col" />
<!-- ALTERNATE: 1 COLUMN -->
<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]-->
<!-- MSIE6 -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/style.css" />
<!-- GRAPHIC THEME -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../../css/mystyle.css" />
<!-- FAVICON -->
<link href="http://elearn.mardi.gov.my/templates/jakyaniteii/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!-- DATEPICKER -->
<link rel="stylesheet" type="text/css" href="../../js/datepicker.css">
<!-- JAVASCRIPTS -->
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/switcher.js"></script>
<script type="text/javascript" src="../../js/toggle.js"></script>
<script type="text/javascript" src="../../js/ui.core.js"></script>
<script type="text/javascript" src="../../js/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
</script>
<script type="text/javascript" src="../../js/datepicker.js"></script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Jumlah Peserta mengikut Kluster</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --><!-- InstanceParam name="sidebar" type="boolean" value="true" --><!-- InstanceParam name="footer" type="boolean" value="true" --><!-- InstanceParam name="header" type="boolean" value="true" -->
</head>

<body>
<div id="main">
	<!-- Tray -->
	<div id="tray" class="box">
		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
            <a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column">
            <img src="../../design/switcher-1col.gif" alt="1 Column" />
            </a><a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns">
            <img src="../../design/switcher-2col.gif" alt="2 Columns" /></a></span>

			E-Latihan: <strong>Program Kursus dan Latihan Teknikal</strong></p>

	  <p class="f-right">Pengguna: <?php echo $_SESSION['SESS_FULLNAME'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href="../../login/logout.php" id="logout">Log keluar</a></strong></p>

  </div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	
	<div id="menu" class="box">      
      <ul class="box">
        <li><div class="buttons"><a href="tambah-kursus.php"><img src="../img/icons/add.png" alt=""/>Kursus</a></div></li>
        <li><div class="buttons"><a href="tambah-lokasi.php"><img src="../img/icons/add.png" alt=""/>Lokasi</a></div></li>
        <li><div class="buttons"><a href="tambah-kategori.php"><img src="../img/icons/add.png" alt=""/>Kluster</a></div></li>
        <li><div class="buttons"><a href="tambah-admin.php"><img src="../img/icons/add.png" alt=""/>Penyelaras</a></div></li>
      </ul>
    </div>

	
	<!-- /header -->

<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		
		<div id="aside" class="box">
          <ul class="box">
          <li id="submenu-active"><a href="../index.php">Halaman Utama</a></li>
			<li id="submenu-active"><a href="#">Kursus</a>
                <ul>
                	<li><a href="../list-kategori.php">Senarai Kluster</a></li>
                  <li><a href="../list-kursus.php">Senarai Kursus</a></li>
                  <li><a href="../list.php">Senarai Penyelaras</a></li>
                  <li><a href="../list-peserta.php">Senarai Peserta</a></li>
                  <li><a href="../list-penceramah.php">Senarai Penceramah</a></li>
                  <li><a href="../list-topik.php">Senarai Topik</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Kewangan</a>
                <ul>
                	<li><a href="../list-bayaran.php">Honorarium</a></li>
                    <li><a href="../list-bayaran-kursus.php">Penyata Perbelanjaan</a></li>
                    <li><a href="../list-bayaran-pendahuluan.php">Bayaran Pendahuluan</a></li>
                    <li><a href="../list-bayaran-invoice.php">Invois</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Rekod Kursus</a>
                <ul>
                	<li><a href="../analisis-kursus.php">Penilaian Kursus</a></li>
                    <li><a href="../analisis-penceramah.php">Penilaian Penceramah</a></li>
                    <li><a href="../analisis-peserta.php">Analisis Peserta</a></li>
                    <li><a href="../analisis-bayaran.php">Analisis Kluster</a></li>
                    <li><a href="../analisis-bulanan.php">Analisis Bulanan</a></li>
                </ul>
            </li>
            </ul>
	    </div>
		
		<!-- /aside -->

    <hr class="noscreen" />

		<!-- Content (Right Column) -->
		<!-- InstanceBeginEditable name="content" -->
		<div id="content" class="box">
		  <!-- Headings -->
          
          <div class="col50">
          <h3 class="t-center">Jumlah Peserta mengikut Kluster</h3>
    <p><!-- ampie script-->
          <script type="text/javascript" src="../../ampie/swfobject.js"></script>
                  <!-- pie 1-->
            <div id="flashcontent1">
                      <strong>You need to upgrade your Flash Player</strong></div>
            <script type="text/javascript">
						// <![CDATA[		
						var so = new SWFObject("../../ampie/ampie.swf", "ampie1", "450", "300", "4", "#FFFFFF");
						so.addVariable("path", "../../ampie/");
						so.addVariable("settings_file", encodeURIComponent("../../ampie/kategori_settings.xml"));
						so.addVariable("data_file", encodeURIComponent("../../ampie/report_kluster_peserta.php"));
						so.write("flashcontent1");
						// ]]>
					</script>
              <!-- end of ampie script -->
              </p>
              <table width="95%">
                  <tr>
                    <th>Kluster</th>
                    <th width="150" class="t-center">Jumlah Peserta</th>
                  </tr>
                  <tr>
                    <td>Teknologi Ternakan</td>
                    <td width="150" class="t-center"><?php echo $row_ternakan['peserta1'] ?></td>
                  </tr>
                  <tr>
                    <td>Teknologi Tanaman</td>
                    <td width="150" class="t-center"><?php echo $row_tanaman['peserta2'] ?></td>
                  </tr>
                  <tr>
                    <td>Teknologi Makanan</td>
                    <td width="150" class="t-center"><?php echo $row_makanan['peserta3'] ?></td>
                  </tr>
                  <tr>
                    <td>Teknologi Lanjutan</td>
                    <td width="150" class="t-center"><?php echo $row_lanjutan['peserta4'] ?></td>
                  </tr>
                  <tr>
                    <td>JUMLAH</td>
                    <?php $total = $row_ternakan['peserta1'] + $row_tanaman['peserta2'] + $row_makanan['peserta3'] + $row_lanjutan['peserta4']; ?>
                    <td class="t-center"><?php echo $total; ?></td>
                  </tr>
            </table>
          </div>
          <div class="col50">
          <h3 class="t-center">Jumlah Kursus mengikut Kluster</h3>
          <p><!-- ampie script-->
                    <script type="text/javascript" src="../../ampie/swfobject.js"></script>
                    <!-- pie 1-->
                <div id="flashcontent2">
                        <strong>You need to upgrade your Flash Player</strong></div>
              <script type="text/javascript">
						// <![CDATA[		
						var so = new SWFObject("../../amcolumn/amcolumn.swf", "amcolumn", "400", "300", "4", "#FFFFFF");
						so.addVariable("path", "../../amcolumn/");
						so.addVariable("settings_file", encodeURIComponent("../../amcolumn/kluster-setting.xml"));
						so.addVariable("data_file", encodeURIComponent("../../amcolumn/report_kluster_peserta.php"));
						so.write("flashcontent2");
						// ]]>
					</script>
                <!-- end of ampie script -->
              </p>
              <table width="95%">
                  <tr>
                    <th>Kluster</th>
                    <th width="150" class="t-center">Kursus</th>
                  </tr>
                  <?php do { ?>
                  <tr>
                    <td><?php echo $row_kursus['ts_kursus_kategori'] ?></td>
                    <td width="150" class="t-center"><?php echo $row_kursus['jumlah'] ?></td>
                  </tr>
              <?php } while ($row_kursus = mysql_fetch_assoc($kursus)); ?>
                    <td>JUMLAH</td>
                    <td class="t-center"><?php echo $row_all['jumlah'] ?></td>
                  </tr>
            </table>
          </div>
          <div class="fix"></div>
          <p>&nbsp;</p>
          <div class="buttons">
              <a href="javascript:history.go(-1)">
              <img src="../img/icons/arrow_undo.png" alt=""/>Kembali</a></div>
              
	    </div>
		<!-- InstanceEndEditable -->
		<!-- /content -->
	</div> 
<!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
	
	<div id="footer" class="box">
      <p class="f-left"><span class="t-left">&copy; 2010 Hakcipta Terpelihara E-Latihan</span></p>
      <p class="f-right"><span class="t-left">Pusat Kursus dan Latihan Teknikal, MARDI</span></p>
	  </div>
  
	<!-- /footer -->
</div> 
<!-- /main -->

</body>
<!-- InstanceEnd --></html>
<?php 
mysql_free_result($tanaman);
mysql_free_result($ternakan);
mysql_free_result($makanan);
mysql_free_result($lanjutan);
mysql_free_result($kursus); 
?>