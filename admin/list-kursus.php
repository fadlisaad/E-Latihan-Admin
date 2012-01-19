<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Senarai kursus.
 */

require_once('../Connections/ts_kursus.php');
require_once('../login/auth.php');
$currentyear	= date('Y');

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


$colname_admin = "-1";
if (isset($_SESSION['SESS_ADMIN_ID'])) {
  $colname_admin = $_SESSION['SESS_ADMIN_ID'];
}

// total paging
if (isset($_GET['id'])) {
	$thisyear	= $_GET['id'];
	}
else {
	$thisyear	= date('Y');
	}
	
	$query 				= "SELECT COUNT(*) FROM ts_kursus WHERE ts_kursus_year = ".$thisyear."";
	$result 			= mysql_query($query) or die(mysql_error());
	$num_rows 			= mysql_fetch_row($result);
	

	mysql_select_db($database_ts_kursus, $ts_kursus);


	$query_admin = sprintf("SELECT * FROM ts_admin, ts_kursus WHERE ts_admin_ID = %s AND ts_kursus.ts_kursus_admin = %s AND ts_kursus.ts_kursus_year = ".$thisyear." ORDER BY ts_kursus.ts_kursus_kod ASC", GetSQLValueString($colname_admin, "int"),GetSQLValueString($colname_admin, "int"));
	
	$admin = mysql_query($query_admin, $ts_kursus) or die(mysql_error());
	$row_admin = mysql_fetch_assoc($admin);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_check_email = "SELECT ts_admin.ts_admin_email, COUNT(ts_mail.ts_email_address), ts_admin.ts_admin_ID FROM ts_admin, ts_mail WHERE ts_admin.ts_admin_email=ts_mail.ts_email_address GROUP BY (ts_mail.ts_email_address)";
$check_email = mysql_query($query_check_email, $ts_kursus) or die(mysql_error());
$row_check_email = mysql_fetch_assoc($check_email);
$totalRows_check_email = mysql_num_rows($check_email);

$today_date = date('Y-m-d');
$colname_new = "-1";
if (isset($today_date)) {
  $colname_new = $today_date;
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_new = sprintf("SELECT COUNT(ts_invoice.peserta_id) as peserta FROM ts_invoice WHERE lastupdate = %s", GetSQLValueString($colname_new, "text"));
$new = mysql_query($query_new, $ts_kursus) or die(mysql_error());
$row_new = mysql_fetch_assoc($new);
$totalRows_new = mysql_num_rows($new);

isset($startRow_admin)? $orderNum=$startRow_admin:$orderNum=0;

$queryString_admin = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_admin") == false && 
        stristr($param, "totalRows_admin") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_admin = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_admin = sprintf("&totalRows_admin=%d%s", $totalRows_admin, $queryString_admin);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php include('meta.php'); ?>
<script type="text/javascript">
	function redirect() {
	if (window.location.search.length <= 1) {
		window.location.href = "list-kursus.php?id=<?php echo $thisyear; ?>";
	}
}
</script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" media="screen" type="text/css" href="../css/demo_table.css" />
<script type="text/javascript">
$(document).ready(function() {
	$('#datatable').dataTable();
});
</script>
<title>Senarai kursus</title>
</head>

<body onLoad="redirect()">
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
        <h3>Senarai kursus bagi tahun <?php echo $thisyear; ?></h3>
			<div class="buttons"><a href="#"><img src="img/icons/magnifier.png" alt=""/>Pilih tahun&nbsp;&raquo;</a></div>
			<?php for($year = 2009; $year < $currentyear+1; $year++) { ?>
			<div class="buttons">
			  <a href="list-kursus.php?id=<?php echo $year ?>">
			  <img src="img/icons/date.png" alt=""/><?php echo $year ?></a>
			</div>
			<?php } ?>
			<br />
			<?php if($num_rows > 0) { ?>
			<div id="demo">
            <table id="datatable" width="100%">
				<thead>
					<tr>
						<th width="15" class="t-center">Bil.</th>
						<th width="60" class="t-center">Kod</th>
						<th class="t-left">Tajuk latihan</th>
						<th width="150" class="t-center">Kluster</th>
						<th width="60" class="t-center">Tahun</th>
					</tr>
				</thead>
				<tbody>
                <?php do { ?>
					<tr>
						<td class="t-center"><?php echo ++$orderNum; ?></td>
						<td class="t-center"><?php echo $row_admin['ts_kursus_kod']; ?></td>
						<td class="t-left">
							<a href="list-peserta-kursus.php?ts_kursus_id=<?php echo $row_admin['ts_kursus_id']; ?>"><?php echo strtoupper($row_admin['ts_kursus_nama']); ?></a>
						</td>
						<td class="t-center"><?php echo $row_admin['ts_kursus_kategori']; ?></td>
						<td class="t-center"><?php echo $row_admin['ts_kursus_year']; ?></td>
					</tr>
				<?php } while ($row_admin = mysql_fetch_assoc($admin)); ?>
				</tbody>
			</table>
			</div>
			<hr />
			<?php } else { ?>
				<p class="msg error">Tiada kursus pada tahun ini.</p>
			<?php } ?>
			<br /><br />
			<div class="fix"></div>
			<div class="buttons">
				<a href="javascript:history.go(-1)"><img src="img/icons/arrow_undo.png" alt=""/>Kembali</a>
			</div>
          </div><!-- InstanceEndEditable -->
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
mysql_free_result($admin);
mysql_free_result($check_email);
mysql_free_result($new);
?>
