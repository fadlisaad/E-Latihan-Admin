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

$colname_public_form = "-1";
if (isset($_POST['First_Name'])) {
  $colname_public_form = $_POST['First_Name'];
}
$colname3_public_form = "-1";
if (isset($_POST['Address'])) {
  $colname3_public_form = $_POST['Address'];
}
$colname2_public_form = "-1";
if (isset($_POST['Phone_No'])) {
  $colname2_public_form = $_POST['Phone_No'];
}
mysql_select_db($database_ebantahan, $ebantahan);
$query_public_form = sprintf("SELECT * FROM public_form WHERE first_name = %s AND phone = %s AND address1 = %s", GetSQLValueString($colname_public_form, "text"),GetSQLValueString($colname2_public_form, "text"),GetSQLValueString($colname3_public_form, "text"));
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
<title>Form PA1-User Copy</title>
</head>

<body>
<p align="right">Form PA1<strong>User Copy</strong></p>
<hr />
<p align="center"><strong>PUBLIC OPINION FORM<br />
DRAFT KUALA LUMPUR CITY PLAN 2020</strong></p>
<hr />
<table border="1" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td width="168" valign="top"><p>Opinion number</p></td>
    <td width="168" valign="top"><p>PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?></p></td>
  </tr>
  <tr>
    <td width="168" valign="top"><p>Date received </p></td>
    <td width="168" valign="top"><p><?php echo $row_public_form['date']; ?></p></td>
  </tr>
</table>
<p><strong>PERSONAL INFORMATION</strong></p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="205">1.Name *</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td width="428" border="1"><p><?php echo $row_public_form['first_name']; ?>&nbsp;<?php echo $row_form['last_name']; ?></p></td>
  </tr>
  <tr>
    <td>2.Identity card no. </td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['ic']; ?> <?php echo $row_form['passport']; ?></p></td>
  </tr>
  <tr>
    <td>3.Name of agency /organisation</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['agency']; ?></p></td>
  </tr>
  <tr>
    <td>4.Postal address</td>
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
    <td>5.Telephone no. that could be <br />
    reached during office hours</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['phone']; ?></p></td>
  </tr>
  <tr>
    <td>6.Facsimile no.</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['fax']; ?></p></td>
  </tr>
  <tr>
    <td>7.E-mail address</td>
    <td width="15"><p><strong>:</strong></p></td>
    <td border="1"><p><?php echo $row_public_form['email']; ?></p></td>
  </tr>
</table>
<hr />
<p><strong>YOUR OPINION TOWARDS THE DRAFT KUALA LUMPUR CITY PLAN 2020</strong></p>
<p>1.With reference to the Kuala Lumpur City Plan 2020, please state the page / index plan no./ location that is related to your opinion.</p>
<table border="0" cellspacing="0" cellpadding="0" width="648">
  <tr>
    <td width="132"><p>Report Volume</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="1"><p><?php echo $row_public_form['cp_page']; ?></p></td>
  </tr>
  <tr>
    <td width="132"><p>Page</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="1"><p><?php echo $row_public_form['cp_paragraph']; ?></p></td>
  </tr>
  <tr>
    <td width="132"><p>Index Plan No.</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="1"><p><?php echo $row_public_form['cp_table']; ?></p></td>
  </tr>
  <tr>
    <td width="132"><p>Location</p></td>
    <td width="19"><p align="right">:</p></td>
    <td width="497" border="1"><p><?php echo $row_public_form['location']; ?></p></td>
  </tr>
  <tr>
    <td>Strategic Zone</td>
    <td>&nbsp;</td>
    <td border="1"><?php echo $row_strategic_zone['desc']; ?></td>
  </tr>
</table>
<p>2.Please state your opinion clearly and give basis for the opinion. (Use additional sheets if necessary)</p>
<p><?php echo $row_public_form['propose_object_desc']; ?></p>
<p>3.Please present opinions and proposals for improvement of  the Draft Kuala Lumpur City Plan 2020. 
( Please attach additional information, plans, photos and others if necessary)</p>
<p><?php echo $row_public_form['suggestion_desc']; ?></p>

</body>
</html>
<?php
mysql_free_result($public_form);
mysql_free_result($tmn);
mysql_free_result($strategic_zone);
?>