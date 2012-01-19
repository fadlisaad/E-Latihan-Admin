<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Listing of category.
 */

error_reporting(0);

require_once('../login/auth.php'); 
require_once('../Connections/ts_kursus.php');

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_add_kategori = "SELECT * FROM ts_kategori";
$add_kategori = mysql_query($query_add_kategori, $ts_kursus) or die(mysql_error());
$row_add_kategori = mysql_fetch_assoc($add_kategori);
$totalRows_add_kategori = mysql_num_rows($add_kategori);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_sum_kategori = "SELECT COUNT(ts_kategori_ID) FROM ts_kategori GROUP BY ts_kategori_year";
$sum_kategori = mysql_query($query_sum_kategori, $ts_kursus) or die(mysql_error());
$row_sum_kategori = mysql_fetch_assoc($sum_kategori);
$totalRows_sum_kategori = mysql_num_rows($sum_kategori);

isset($startRow_add_kategori)? $orderNum=$startRow_add_kategori:$orderNum=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><?php include('meta.php'); ?>
<?php include('meta.php'); ?>
<script type="text/javascript" src="script/jquery.jeditable.mini.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	$(".tabs > ul").tabs();
	$('.kategori').editable('save-kategori.php', {
		 id		: 'id',
		 submit : 'Save'
	});
});
</script>
<title>Senarai Kluster Kursus</title>
</head>
<body>
<div id="main">
	<!-- Tray -->
	<?php include('tray.php'); ?>
	<hr class="noscreen" />
	<!-- Menu -->
	<?php include('top.php'); ?>
	<hr class="noscreen" />
	<!-- Columns -->
	<div id="cols" class="box">
	<!-- Aside (Left Column) -->
	<?php include('aside.php'); ?>
    <hr class="noscreen" />
	<!-- Content (Right Column) -->
		<div id="content">
             <h3>Kluster Kursus dan Latihan Amali</h3>
			 <hr />
             <div class="buttons">
              <a href="tambah-kategori.php">
              <img src="img/icons/add.png" alt=""/>Tambah Kluster</a></div>
              <div class="buttons">
              <a href="javascript:history.go(-1)">
              <img src="img/icons/arrow_undo.png" alt=""/>Kembali</a></div>
              <div class="fix"></div>
             <p class="msg info">Terdapat <?php echo $row_sum_kategori['COUNT(ts_kategori_ID)']; ?> kluster dalam sistem ini sekarang. Klik pada kategori untuk mengubah</p>
                 
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <th width="5%" class="t-center"><strong>Bil</strong></th>
                  <th>Nama Kategori</th>
				  <th width="120" class="t-center">Senarai Kursus</th>
                  <th width="40" class="t-center">Padam</th>
                  </tr>
                <?php do { ?>
                  <tr>
                    <td width="5%" class="t-center"><?php echo ++$orderNum; ?></td>
            <td><a href="#"><div class="kategori" id="<?php echo $row_add_kategori['ts_kategori_ID']; ?>"><?php echo $row_add_kategori['ts_kategori_nama']; ?></div></a></td>
			<td class="t-center">
			<a href="list-kursus-kategori.php?ts_kursus_kategori=<?php echo $row_add_kategori['ts_kategori_nama']; ?>">Papar</a></td>
            <td class="t-center"><a href="padam-kategori.php?ts_kategori_ID=<?php echo $row_add_kategori['ts_kategori_ID']; ?>" onClick="javascript: return confirm('Anda pasti ingin memadam kluster ini? \nKlik OK untuk padam. \nKlik CANCEL untuk kembali.');"><img src="img/icons/delete.png" title="Delete" width="16" height="16" /></a></td>
          </tr>
                  <?php } while ($row_add_kategori = mysql_fetch_assoc($add_kategori)); ?>
              </table>

            </div>
		<!-- /content -->
	</div> 
<!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
		<?php include('footer.php'); ?>
	<!-- /footer -->
</div> 
<!-- /main -->

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($add_kategori);
mysql_free_result($sum_kategori);
?>