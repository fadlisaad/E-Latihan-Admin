<?php require_once('../Connections/ts_kursus.php'); 

mysql_select_db($database_ts_kursus, $ts_kursus);

$query_pekerjaan = "SELECT COUNT(ts_peserta_ID) AS pekerjaan, ts_peserta_pekerjaan FROM ts_peserta GROUP BY ts_peserta_pekerjaan";
$pekerjaan = mysql_query($query_pekerjaan, $ts_kursus) or die(mysql_error());
$row_pekerjaan = mysql_fetch_assoc($pekerjaan);
$totalRows_pekerjaan = mysql_num_rows($pekerjaan);

$query_perusahaan = "SELECT COUNT(ts_peserta_ID) AS perusahaan, ts_peserta_perusahaan FROM ts_peserta GROUP BY ts_peserta_perusahaan";
$perusahaan = mysql_query($query_perusahaan, $ts_kursus) or die(mysql_error());
$row_perusahaan = mysql_fetch_assoc($perusahaan);
$totalRows_perusahaan = mysql_num_rows($perusahaan);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!-- InstanceBegin template="/Templates/Admin_Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="en" />
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/reset.css" />
<!-- RESET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/main.css" />
<!-- MAIN STYLE SHEET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/2col.css" title="2col" />
<!-- DEFAULT: 2 COLUMNS -->
<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../css/1col.css" title="1col" />
<!-- ALTERNATE: 1 COLUMN -->
<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]-->
<!-- MSIE6 -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/style.css" />
<!-- GRAPHIC THEME -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/mystyle.css" />
<!-- FAVICON -->
<link href="http://elearn.mardi.gov.my/templates/jakyaniteii/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!-- DATEPICKER -->
<link rel="stylesheet" type="text/css" href="../js/datepicker.css">
<!-- JAVASCRIPTS -->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/switcher.js"></script>
<script type="text/javascript" src="../js/toggle.js"></script>
<script type="text/javascript" src="../js/ui.core.js"></script>
<script type="text/javascript" src="../js/ui.tabs.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
</script>
<script type="text/javascript" src="../js/datepicker.js"></script>
<!-- END OF HEADER -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>Analisis - Peserta</title>
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
            <img src="../design/switcher-1col.gif" alt="1 Column" />
            </a><a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns">
            <img src="../design/switcher-2col.gif" alt="2 Columns" /></a></span>

			E-Latihan: <strong>Program Kursus dan Latihan Teknikal</strong></p>

	  <p class="f-right">Pengguna: <?php echo $_SESSION['SESS_FULLNAME'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href="../login/logout.php" id="logout">Log keluar</a></strong></p>

  </div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	
	<div id="menu" class="box">      
      <ul class="box">
        <li><div class="buttons"><a href="tambah-kursus.php"><img src="img/icons/add.png" alt=""/>Kursus</a></div></li>
        <li><div class="buttons"><a href="tambah-lokasi.php"><img src="img/icons/add.png" alt=""/>Lokasi</a></div></li>
        <li><div class="buttons"><a href="tambah-kategori.php"><img src="img/icons/add.png" alt=""/>Kluster</a></div></li>
        <li><div class="buttons"><a href="tambah-admin.php"><img src="img/icons/add.png" alt=""/>Penyelaras</a></div></li>
      </ul>
    </div>

	
	<!-- /header -->

<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		
		<div id="aside" class="box">
          <ul class="box">
          <li id="submenu-active"><a href="index.php">Halaman Utama</a></li>
			<li id="submenu-active"><a href="#">Kursus</a>
                <ul>
                	<li><a href="list-kategori.php">Senarai Kluster</a></li>
                  <li><a href="list-kursus.php">Senarai Kursus</a></li>
                  <li><a href="list.php">Senarai Penyelaras</a></li>
                  <li><a href="list-peserta.php">Senarai Peserta</a></li>
                  <li><a href="list-penceramah.php">Senarai Penceramah</a></li>
                  <li><a href="list-topik.php">Senarai Topik</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Kewangan</a>
                <ul>
                	<li><a href="list-bayaran.php">Honorarium</a></li>
                    <li><a href="list-bayaran-kursus.php">Penyata Perbelanjaan</a></li>
                    <li><a href="list-bayaran-pendahuluan.php">Bayaran Pendahuluan</a></li>
                    <li><a href="list-bayaran-invoice.php">Invois</a></li>
                </ul>
            </li>
            <li id="submenu-active"><a href="#">Rekod Kursus</a>
                <ul>
                	<li><a href="analisis-kursus.php">Penilaian Kursus</a></li>
                    <li><a href="analisis-penceramah.php">Penilaian Penceramah</a></li>
                    <li><a href="analisis-peserta.php">Analisis Peserta</a></li>
                    <li><a href="analisis-bayaran.php">Analisis Kluster</a></li>
                    <li><a href="analisis-bulanan.php">Analisis Bulanan</a></li>
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
		  <h2>Analisis Pekerjaan / Perusahaan</h2>

        <script type="text/javascript">
						// <![CDATA[		
						var so = new SWFObject("../amcolumn/amcolumn.swf", "amcolumn", "800", "400", "4", "#FFFFFF");
						so.addVariable("path", "../amcolumn/");
						so.addVariable("settings_file", encodeURIComponent("../amcolumn/bulanan-setting.xml"));
						so.addVariable("data_file", encodeURIComponent("../amcolumn/bulanan-data.php"));
						so.write("flashcontent");
						// ]]>
					</script>
              <!-- end of ampie script -->
              </p>
          <div class="col50">
          <h3 class="t-center">Jumlah Peserta mengikut Pekerjaan</h3>
    <p><!-- ampie script-->
          <script type="text/javascript" src="../ampie/swfobject.js"></script>
                  <!-- pie 1-->
            <div id="flashcontent1">
                      <strong>You need to upgrade your Flash Player</strong></div>
            <script type="text/javascript">
						// <![CDATA[		
						var so = new SWFObject("../ampie/ampie.swf", "ampie1", "450", "300", "4", "#FFFFFF");
						so.addVariable("path", "../ampie/");
						so.addVariable("settings_file", encodeURIComponent("../ampie/pekerjaan_setting.xml"));
						so.addVariable("data_file", encodeURIComponent("../ampie/report_pekerjaan_peserta.php"));
						so.write("flashcontent1");
						// ]]>
					</script>
              <!-- end of ampie script -->
              </p>
              <table width="95%">
                  <tr>
                    <th>Pekerjaan</th>
                    <th width="150" class="t-center">Jumlah Peserta</th>
                  </tr>
                  <?php do { ?>
                  <tr>
                    <td><?php echo strtoupper($row_pekerjaan['ts_peserta_pekerjaan']); ?></td>
                    <td width="150" class="t-center"><?php echo $row_pekerjaan['pekerjaan']; ?></td>
                  </tr>
                  <?php } while ($row_pekerjaan = mysql_fetch_assoc($pekerjaan)); ?>
            </table>
          </div>
		  <!-- /col50 -->
          <div class="col50 f-right">
          <h3 class="t-center">Jumlah Peserta mengikut Perusahaan</h3>
    <p><!-- ampie script-->
          <script type="text/javascript" src="../ampie/swfobject.js"></script>
                  <!-- pie 1-->
            <div id="flashcontent2">
                      <strong>You need to upgrade your Flash Player</strong></div>
            <script type="text/javascript">
						// <![CDATA[		
						var so = new SWFObject("../ampie/ampie.swf", "ampie1", "450", "300", "4", "#FFFFFF");
						so.addVariable("path", "../ampie/");
						so.addVariable("settings_file", encodeURIComponent("../ampie/perusahaan_setting.xml"));
						so.addVariable("data_file", encodeURIComponent("../ampie/report_perusahaan_peserta.php"));
						so.write("flashcontent2");
						// ]]>
					</script>
              <!-- end of ampie script -->
              </p>
              <table width="95%">
                  <tr>
                    <th>Perusahaan</th>
                    <th width="150" class="t-center">Jumlah Peserta</th>
                  </tr>
                  <?php do { ?>
                  <tr>
                    <td><?php echo strtoupper($row_perusahaan['ts_peserta_perusahaan']); ?></td>
                    <td width="150" class="t-center"><?php echo $row_perusahaan['perusahaan']; ?></td>
                  </tr>
                  <?php } while ($row_perusahaan = mysql_fetch_assoc($perusahaan)); ?>
            </table>
          </div>
		  <!-- /col50 -->
          <div class="fix"></div>
		  <!-- 3 columns -->
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
mysql_free_result($pekerjaan);
mysql_free_result($perusahaan);
?>