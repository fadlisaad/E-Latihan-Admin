<?php 
require_once('../Connections/ebantahan.php'); 

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
$query_public_form = "SELECT * FROM public_form ORDER BY id DESC";
$public_form = mysql_query($query_public_form, $ebantahan) or die(mysql_error());
$row_public_form = mysql_fetch_assoc($public_form);
$totalRows_public_form = mysql_num_rows($public_form);
?>
<html>
<head>
<title><?php echo $site_title; ?></title>
</head>

<body>
<div class="print">
  <p>PENERIMAAN BORANG PANDANGAN AWAM</p>
  <p>No Rujukan Pandangan: DBKL/PTKL2020/DRAFT/<?php echo $row_public_form['id']; ?></p>
  <p>Tarikh diterima:<?php echo $row_public_form['date']; ?></p>
  
  <p align="justify">Dimaklumkan   bahawa Jabatan ini telah menerima Borang Pandangan Awam anda mengenai   Draf Pelan Bandar Raya Kuala Lumpur 2020 dan sedang mengambil tindakan.   Jabatan ini mengucapkan ribuan terima kasih di atas pandangan yang telah   dikemukakan.</p>
    
  <p align="justify">Sekiranya   anda memilih untuk hadir bagi menjelaskan pandangan di sesi pendengaran,   anda akan dimaklumkan kemudian mengenai tarikh, masa dan tempat sesi   pendengaran. Anda juga boleh menyemaknya di laman web <a href="http://www.klcityplan2020.dbkl.gov.my" target="_blank">www.klcityplan2020.dbkl.gov.my</a> dengan menggunakan nombor pandangan di atas sebagai rujukan.&nbsp;<br>
    &nbsp;<br>
    Sekian.&nbsp;<br>
  Pengarah<br>
  Jabatan Pelan   Induk<br>
  Dewan Bandaraya   Kuala Lumpur<br>
  b.p. Datuk   Bandar Kuala Lumpur&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($public_form);
?>