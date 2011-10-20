<?php require_once('../Connections/ebantahan.php'); ?>
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
$query_public_form = "SELECT * FROM public_form WHERE type = 'Individual' ORDER BY public_form.id";
$public_form = mysql_query($query_public_form, $ebantahan) or die(mysql_error());
$row_public_form = mysql_fetch_assoc($public_form);
$totalRows_public_form = mysql_num_rows($public_form);

$colname_strategic_zone = "-1";
if (isset($_GET['id'])) {
  $colname_strategic_zone = $_GET['id'];
}
mysql_select_db($database_ebantahan, $ebantahan);
$query_strategic_zone = sprintf("SELECT strategic_zone.desc FROM public_form, strategic_zone WHERE strategic_zone.id = public_form.cp_figure and public_form.id = %s", GetSQLValueString($colname_strategic_zone, "int"));
$strategic_zone = mysql_query($query_strategic_zone, $ebantahan) or die(mysql_error());
$row_strategic_zone = mysql_fetch_assoc($strategic_zone);
$totalRows_strategic_zone = mysql_num_rows($strategic_zone);

mysql_select_db($database_ebantahan, $ebantahan);
$query_public_form2 = "SELECT * FROM public_form WHERE type = 'Group' ORDER BY public_form.id";
$public_form2 = mysql_query($query_public_form2, $ebantahan) or die(mysql_error());
$row_public_form2 = mysql_fetch_assoc($public_form2);
$totalRows_public_form2 = mysql_num_rows($public_form2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Senarai Borang PA2</title>
</head>

<body>
<p align="right">Senarai Nama Dan Alamat Pemberi Pandangan </p>
<hr />
<p align="center"><strong>SENARAI NAMA DAN ALAMAT PEMBERI   PANDANGAN AWAM <br />
DRAF PELAN BANDAR RAYA KUALA LUMPUR 2020</strong></p>
<hr />
<strong>
 KATEGORI : INDIVIDU</strong>
<table width="100%" border="1">
  <tr>
    <td><strong>ID <br />
    Pandangan</strong></td>
    <td><strong>Nama</strong></td>
    <td><strong>Tarikh Terima</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td rowspan="3">PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?></td>
      <td><?php echo $row_public_form['first_name']; ?></td>
      <td rowspan="3"><?php echo $row_public_form['date']; ?></td>
    </tr>
    <tr>
      <td><?php echo $row_public_form['address1']; ?> <?php echo $row_public_form['address2']; ?>
      <br />
      <?php echo $row_public_form['postal_code']; ?> <?php echo $row_public_form['city']; ?><br />
      <?php echo $row_public_form['state']; ?></td>
    </tr>
    <tr>
      <td><?php echo $row_public_form['email']; ?></td>
    </tr>
    <?php } while ($row_public_form = mysql_fetch_assoc($public_form)); ?>
</table>
<p>&nbsp;</p>
<hr />
<strong> KATEGORI : GROUP</strong>
<table width="100%" border="1">
  <tr>
    <td><strong>ID <br />
      Pandangan</strong></td>
    <td><strong>Nama</strong></td>
    <td><strong>Tarikh Terima</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td rowspan="3">PTKL2020/DRAFT/<?php echo $row_public_form2['id']; ?></td>
      <td><?php echo $row_public_form2['first_name']; ?></td>
      <td rowspan="3"><?php echo $row_public_form2['date']; ?></td>
    </tr>
    <tr>
      <td><?php echo $row_public_form2['address1']; ?> <?php echo $row_public_form2['address2']; ?><br />
      <?php echo $row_public_form2['postal_code']; ?> <?php echo $row_public_form2['city']; ?><br />
      <?php echo $row_public_form2['state']; ?></td>
    </tr>
    <tr>
      <td><?php echo $row_public_form2['email']; ?></td>
    </tr>
    <?php } while ($row_public_form2 = mysql_fetch_assoc($public_form2)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($public_form);
mysql_free_result($strategic_zone);

mysql_free_result($public_form2);
?>
