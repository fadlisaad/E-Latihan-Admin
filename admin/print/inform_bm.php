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

$First_Name = $_POST['First_Name2'];
$agency = $_POST['agency2'];
$type = $_POST['type2'];
$Address = $_POST['Address2'];
$address2 = $_POST['address'];
$city = $_POST['city2'];
$state = $_POST['state2'];
$postal_code = $_POST['postal_code2'];
$country = $_POST['country2'];
$ic = $_POST['ic2'];
$Phone_No = $_POST['Phone_No2'];
$fax = $_POST['fax2'];
$email = $_POST['email2'];
$propose_object = $_POST['propose_object2'];
$cp_page = $_POST['cp_page2'];
$cp_paragraph = $_POST['cp_paragraph2'];
$cp_table = $_POST['cp_table2'];
$cp_figure = $_POST['cp_figure2'];
//$cp_plan = $_POST['cp_plan'];
$propose_object_desc = $_POST['propose_object_desc2'];
$suggestion_desc = $_POST['suggestion_desc2'];
//$upload = $_POST['upload'];
$hearing_session = $_POST['hearing_session2'];
$form_type = $_POST['form_type2'];
$date = $_POST['date2'];
$time = $_POST['time2'];
$add_form = $_POST['add_form2'];
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
$query_public_form = "SELECT * FROM public_form WHERE first_name = '$First_Name' AND phone = '$Phone_No'";
$public_form = mysql_query($query_public_form, $ebantahan) or die(mysql_error());
$row_public_form = mysql_fetch_assoc($public_form);
$totalRows_public_form = mysql_num_rows($public_form);
?>
<img src="top.jpg" width="100" height="65">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Pandangan: PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?>
<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tarikh diterima: <?php echo $row_public_form['date']; ?><br /><br />
Dimaklumkan bahawa Jabatan ini telah menerima Borang Pandangan Awam anda mengenai Draf Pelan Bandar Raya Kuala Lumpur 2020 dan sedang mengambil tindakan. Jabatan ini mengucapkan ribuan terima kasih di atas pandangan yang telah  dikemukakan.
<br /><br />Sekiranya anda memilih untuk hadir bagi menjelaskan pandangan di sesi pendengaran, anda akan dimaklumkan kemudian mengenai tarikh, masa dan tempat sesi pendengaran. Anda juga boleh menyemaknya di laman web <b>klcityplan2020.dbkl.gov.my/eopinion</b> dengan menggunakan nombor pandangan di atas sebagai rujukan.
<br /><br />Sekian
<br /><br />Pengarah
<br />Jabatan Pelan Induk
<br />Dewan Bandaraya Kuala Lumpur
<br />b.p. Datuk Bandar Kuala Lumpur
<?php
mysql_free_result($public_form);
?>
