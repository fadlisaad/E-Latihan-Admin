<?php require_once('../Connections/ts_kursus.php'); ?>
<?php
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_lokasi_senarai = "SELECT * FROM ts_tempat_kursus";
$lokasi_senarai = mysql_query($query_lokasi_senarai, $ts_kursus) or die(mysql_error());
$row_lokasi_senarai = mysql_fetch_assoc($lokasi_senarai);
$totalRows_lokasi_senarai = mysql_num_rows($lokasi_senarai);

isset($startRow_lokasi_senarai)? $orderNum=$startRow_lokasi_senarai:$orderNum=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!-- InstanceBegin template="/elatihan/ts/templates/Web 2.dwt" codeOutsideHTMLIsLocked="false" -->
<HEAD><META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Home</title>
<!-- InstanceEndEditable -->
<META http-equiv="content-language" content="en">
	<META name="rating" content="general">
	<META name="description" content="">
	<META name="keywords" content="">
<LINK rel="stylesheet" href="global.css" type="text/css" media="screen">
<LINK rel="stylesheet" href="table.css" type="text/css" media="screen">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</HEAD><BODY>
<DIV id="columnleft">		
<A href="index.php" title="MARDILMS"><IMG src="../images/site_logo.gif" width="180" height="60" alt="MARDILMS"></A>
  <DIV id="navwrap">
	<UL class="navparent">
          <LI class="blue"><a href="../kursus_senarai.php"><?php echo _("Senarai Kursus"); ?></a></LI>
          <LI class="green"><a href="scope.php"><?php echo _("Skop Perkhidmatan"); ?></a></LI>
          <LI class="orange"><a href="target_group.php"><?php echo _("Kumpulan Sasaran"); ?></a></LI>
          <LI class="blue"><A href="location.php" title="Loaction Address"><?php echo _("Alamat Lokasi"); ?></A></LI>
          <LI class="green"><A href="story.php" title="Success Story"><?php echo _("Kisah Kejayaan"); ?></A></LI>
          <LI class="orange"><A href="gallery.php" title="Gallery"><?php echo _("Galeri"); ?></A></LI>
          <LI class="orange"><A href="news.php" title="News"><?php echo _("Berita"); ?></A></LI>
     </UL>
     <UL class="navchild">
         <LI><A href="about.php" title="About Us"><?php echo _("Tentang Kami"); ?></A></LI>
         <LI><A href="customer.php" title="Customer Center"><?php echo _("Khidmat Pelanggan"); ?></A></LI>
         <LI><a href="contact.php"><?php echo _("Hubungi Kami"); ?></a></LI>
       	<LI><A href="feedback.php" title="Feedback &amp; Comment"><?php echo _("Komen &amp; Pendapat"); ?></A></LI>
      </UL>
   </DIV>
</DIV>

<DIV id="columnright"><BR>
  <!-- InstanceBeginEditable name="content" -->
  <h2>Senarai Lokasi</h2>
  <table class="sortable" width="100%" border="0">
  <thead>
    <tr>
      <th width="5%" class="tcenter"><strong>Bil</strong></th>
      <th class="tcenter"><strong>Tempat</strong></th>
      <th class="tcenter"><strong>Pengurus</strong></th>
      <th width="20%" class="tcenter"><strong>Telefon</strong></th>
      <th width="20%" class="tcenter"><strong>Peta</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php do { ?>
      <tr>
        <td width="5%" valign="top" class="tcenter"><?php echo ++$orderNum; ?></td>
        <td valign="top"><p><?php echo $row_lokasi_senarai['ts_tempat_nama']; ?>, <?php echo $row_lokasi_senarai['ts_tempat_alamat']; ?></p></td>
        <td valign="top" class="tcenter"><p><?php echo $row_lokasi_senarai['ts_tempat_pengurus']; ?></p></td>
        <td valign="top" class="tcenter"><?php echo $row_lokasi_senarai['ts_tempat_telefon']; ?></td>
        <td valign="top" class="tcenter"><img src="upload/<?php echo $row_lokasi_senarai['ts_tempat_peta']; ?>" alt="-Tiada Peta-" width="100" height="100" id="test" /></td>
      </tr>
      <?php } while ($row_lokasi_senarai = mysql_fetch_assoc($lokasi_senarai)); ?>
      </tbody>
  </table>
<!-- InstanceEndEditable -->
  <DIV id="copyright"><?php echo _("© 2009 Pusat Perkhidmatan Teknikal TS01"); ?>
  </DIV>
</DIV>
</BODY><!-- InstanceEnd --></HTML>
<?php
mysql_free_result($lokasi_senarai);
?>