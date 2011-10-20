<?php require_once('../Connections/ebantahan.php'); ?>
<?php
$First_Name = $_POST['First_Name'];
$agency = $_POST['agency'];
$type = $_POST['type'];
$Address = $_POST['Address'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$postal_code = $_POST['postal_code'];
$country = $_POST['country'];
$ic = $_POST['ic'];
$Phone_No = $_POST['Phone_No'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$propose_object = $_POST['propose_object'];                      
$cp_page = $_POST['cp_page'];
$cp_paragraph = $_POST['cp_paragraph'];
$cp_table = $_POST['cp_table'];
$cp_figure = $_POST['cp_figure'];
//$cp_plan = $_POST['cp_plan'];
$propose_object_desc = $_POST['propose_object_desc'];
$suggestion_desc = $_POST['suggestion_desc'];
//$upload = $_POST['upload'];
$hearing_session = $_POST['hearing_session'];
$form_type = $_POST['form_type'];
$date = $_POST['date'];
$time = $_POST['time'];
$add_form = $_POST['add_form'];
?>
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

mysql_select_db($database_ebantahan, $ebantahan);
$query_public_form = "SELECT * FROM public_form WHERE first_name = '$First_Name' and address1 = '$Address' and phone = '$Phone_No'";
$public_form = mysql_query($query_public_form, $ebantahan) or die(mysql_error());
$row_public_form = mysql_fetch_assoc($public_form);
$totalRows_public_form = mysql_num_rows($public_form);

mysql_select_db($database_ebantahan, $ebantahan);
$query_tmn = "SELECT strategic_zone.desc, taman.id_taman, taman.id_SZ, taman.name FROM strategic_zone, taman WHERE taman.id_SZ = strategic_zone.id ORDER BY taman.name ASC"; 
$tmn = mysql_query($query_tmn, $ebantahan) or die(mysql_error());
$row_tmn = mysql_fetch_assoc($tmn);
$totalRows_tmn = mysql_num_rows($tmn);

mysql_select_db($database_ebantahan, $ebantahan);
$query_strategic_zone = "SELECT * FROM public_form, strategic_zone WHERE strategic_zone.id = public_form.cp_figure and cp_figure = '$cp_figure'";
$strategic_zone = mysql_query($query_strategic_zone, $ebantahan) or die(mysql_error());
$row_strategic_zone = mysql_fetch_assoc($strategic_zone);
$totalRows_strategic_zone = mysql_num_rows($strategic_zone);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Borang PA1-Salinan</title>
</head>

<body>
<p align="right">Salinan <strong>Borang PA 1</strong> </p>
<hr />
<p align="center"><strong>BORANG PANDANGAN AWAM <br />
DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020</strong></p>
<hr />
<table border="1" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td width="168" valign="top"><p>No pandangan </p></td>
    <td width="168" valign="top"><p>PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?></p></td>
  </tr>
  <tr>
    <td width="168" valign="top"><p>Tarikh terima </p></td>
    <td width="168" valign="top"><p><?php echo $row_public_form['date']; ?></p></td>
  </tr>
</table>
<p><strong>BUTIRAN PEMBERI PANDANGAN</strong></p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="205">1.Nama *</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td width="428" border="1"><p><?php echo $row_public_form['first_name']; ?>&nbsp;<?php echo $row_form['last_name']; ?></p></td>
  </tr>
  <tr>
    <td>2.No kad pengenalan </td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['ic']; ?> <?php echo $row_form['passport']; ?></p></td>
  </tr>
  <tr>
    <td>3.Nama agensi </td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['agency']; ?></p></td>
  </tr>
  <tr>
    <td>4.Alamat surat menyurat  * </td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['address1']; ?>,<?php echo $row_form['address2']; ?></p></td>
  </tr>
  <tr>
    <td><p>&nbsp;</p></td>
    <td width="15"></td>
    <td border="1"><p><?php echo $row_public_form['postal_code']; ?>&nbsp;<?php echo $row_form['city']; ?></p></td>
  </tr>
  <tr>
    <td><p>&nbsp;</p></td>
    <td width="15"></td>
    <td border="1"><p><?php echo $row_public_form['state']; ?>&nbsp;<?php echo $row_form['country']; ?></p></td>
  </tr>
  <tr>
    <td>5.No. Telelefon yang boleh <br />
    dihubungi pada waktu pejabat *</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['phone']; ?></p></td>
  </tr>
  <tr>
    <td>6.No Faksimili.</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['fax']; ?></p></td>
  </tr>
  <tr>
    <td>7.Alamat E-mail</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['email']; ?></p></td>
  </tr>
</table>
<hr />
<p><strong>BUTIRAN PANDANGAN AWAM TERHADAP DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020</strong></p>
<p>1.Dengan merujuk Draf Pelan Bandar Raya Kuala Lumpur 2020, sila nyatakan samada muka surat/ no.pelan indeks/ lokasi berkaitan dengan pandangan anda. </p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="132"><p>Jilid Laporan</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="1"><p><?php echo $row_public_form['cp_page']; ?></p></td>
  </tr>
  <tr>
    <td width="132"><p>Muka surat</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="1"><p><?php echo $row_public_form['cp_paragraph']; ?></p></td>
  </tr>
  <tr>
    <td width="132"><p>No. Plan Index</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="1"><p><?php echo $row_public_form['cp_table']; ?></p></td>
  </tr>
  <tr>
    <td width="132"><p>Lokasi</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="1"><p><?php echo $row_strategic_zone['desc']; ?></p></td>
  </tr>
</table>
<p>2.Sila nyatakan dengan jelas pandangan anda dan berikan asas kepada pandangan tersebut.(Gunakan helaian tambahan jika perlu)</p>
<p><?php echo $row_public_form['propose_object_desc']; ?></p>
<p>3.Sila kemukakan pandangan / cadangan bagi menambahbaik Draf Pelan Bandar Raya Kuala Lumpur 2020.<br />
  (Sila lampirkan maklumat tambahan, pelan, gambar dan lain-lain jika perlu)</p>
<p><?php echo $row_public_form['suggestion_desc']; ?></p>

</body>
</html>
<?php
mysql_free_result($public_form);
mysql_free_result($tmn);
mysql_free_result($strategic_zone);
?>