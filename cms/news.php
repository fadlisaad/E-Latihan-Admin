<?php require_once('../Connections/ts_kursus.php'); ?>
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
$query_news = "SELECT * FROM ts_cms WHERE ts_cms.cms_url='N'";
$news = mysql_query($query_news, $ts_kursus) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!-- InstanceBegin template="/elatihan/ts/templates/Web 2.dwt" codeOutsideHTMLIsLocked="false" -->
<HEAD><META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo _("Latest News"); ?></title>
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
  <div id="content">
    <h2>Berita dan Peristiwa</h2>
    <h1><span>Kejayaan kursus adalah suatu kenangan manis yang mungki tidak dapat dilupakan. Maka, kami abadikan kenangan itu dalam satu persembahan bergambar.</span></h1>
    <?php do { ?>
    <h3><?php echo $row_news['cms_title']; ?></h3>
    <p class="featurenote"><?php echo $row_news['cms_lastupdate']; ?></p>
    <p><?php echo $row_news['cms_content']; ?></p>
      <?php } while ($row_news = mysql_fetch_assoc($news)); ?>
  </div>
  <!-- InstanceEndEditable -->
  <DIV id="copyright"><?php echo _("© 2009 Pusat Perkhidmatan Teknikal TS01"); ?>
  </DIV>
</DIV>
</BODY><!-- InstanceEnd --></HTML>
<?php
mysql_free_result($news);
?>