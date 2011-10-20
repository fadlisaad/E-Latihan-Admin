<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!-- InstanceBegin template="/elatihan/ts/templates/Web 2.dwt" codeOutsideHTMLIsLocked="false" -->
<HEAD><META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo _("TS01 Tehnical Service"); ?></title>
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

  <h2>Komen dan Pendapat telah dihantar</h2>
  <h1><span>Terima kasih diatas komen/pendapat/cadangan anda. </span></h1>
  <p><?php echo $_POST['lastname']; ?></p>
  <?php
	$to = $_POST['email'];
	$subject = "Salinan Komen/Pendapat/Cadangan dari MARDILMS (Kursus Terbuka)";

	$message = "Assalamualaikum dan salam sejahtera ". $_POST['lastname'].".\n";

	$message .= "Berikut adalah keterangan komen/pendapat/cadangan anda\n\n";
	$message .= "Nama: ".$_POST['lastname']."\n";
	$message .= "E-mail: ".$_POST['email']."\n";
	$message .= "Telefon: ".$_POST['tel']."\n";
	$message .= "Komen tentang: ".$_POST['choice']."\n";
	$message .= "Mesej: ".$_POST['messege']."\n";
	$message .= "Untuk keterangan lanjut sila hubungi urusetia kursus di talian 03-89437238 (TS01).\n\n";
	$message .= "Sekian.\n\n";
	$message .= "Pengurusan Kursus Teknikal, TS01, MARDI Serdang\n\n";
	$message .= "Hakcipta terpelihara TS01 untuk MARDILMS. Dijana oleh komputer. Tandatangan tidak diperlukan.";
	$from = "noreply@mardi.my";
	$headers = "From: $from";
	mail($to,$subject,$message,$headers);
?>
  <!-- InstanceEndEditable -->
  <DIV id="copyright"><?php echo _("© 2009 Pusat Perkhidmatan Teknikal TS01"); ?>
  </DIV>
</DIV>
</BODY><!-- InstanceEnd --></HTML>