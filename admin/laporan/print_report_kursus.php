<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : main script for denying access to the backend.
 */
	error_reporting(0);

?>
<?php require_once('../../Connections/ts_kursus.php'); ?>
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

$maxRows_count_kursus = 5;
$pageNum_count_kursus = 0;
if (isset($_GET['pageNum_count_kursus'])) {
  $pageNum_count_kursus = $_GET['pageNum_count_kursus'];
}
$startRow_count_kursus = $pageNum_count_kursus * $maxRows_count_kursus;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_count_kursus = "SELECT ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_kategori,COUNT(ts_kursus_id) FROM ts_kursus GROUP BY ts_kursus_kategori ORDER BY COUNT(ts_kursus_id) desc";
$query_limit_count_kursus = sprintf("%s LIMIT %d, %d", $query_count_kursus, $startRow_count_kursus, $maxRows_count_kursus);
$count_kursus = mysql_query($query_limit_count_kursus, $ts_kursus) or die(mysql_error());
$row_count_kursus = mysql_fetch_assoc($count_kursus);

if (isset($_GET['totalRows_count_kursus'])) {
  $totalRows_count_kursus = $_GET['totalRows_count_kursus'];
} else {
  $all_count_kursus = mysql_query($query_count_kursus);
  $totalRows_count_kursus = mysql_num_rows($all_count_kursus);
}
$totalPages_count_kursus = ceil($totalRows_count_kursus/$maxRows_count_kursus)-1;

$maxRows_count_penaja = 5;
$pageNum_count_penaja = 0;
if (isset($_GET['pageNum_count_penaja'])) {
  $pageNum_count_penaja = $_GET['pageNum_count_penaja'];
}
$startRow_count_penaja = $pageNum_count_penaja * $maxRows_count_penaja;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_count_penaja = "SELECT ts_vendor.kursus_vendor_nama, ts_kursus.ts_kursus_vendor,COUNT(kursus_vendor_nama) FROM ts_vendor, ts_kursus WHERE ts_kursus.ts_kursus_vendor=ts_vendor.kursus_vendor_nama GROUP BY kursus_vendor_nama";
$query_limit_count_penaja = sprintf("%s LIMIT %d, %d", $query_count_penaja, $startRow_count_penaja, $maxRows_count_penaja);
$count_penaja = mysql_query($query_limit_count_penaja, $ts_kursus) or die(mysql_error());
$row_count_penaja = mysql_fetch_assoc($count_penaja);

if (isset($_GET['totalRows_count_penaja'])) {
  $totalRows_count_penaja = $_GET['totalRows_count_penaja'];
} else {
  $all_count_penaja = mysql_query($query_count_penaja);
  $totalRows_count_penaja = mysql_num_rows($all_count_penaja);
}
$totalPages_count_penaja = ceil($totalRows_count_penaja/$maxRows_count_penaja)-1;

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_report_admin = "SELECT ts_admin_ID, ts_admin_nama FROM ts_admin ORDER BY ts_admin_ID ASC";
$report_admin = mysql_query($query_report_admin, $ts_kursus) or die(mysql_error());
$row_report_admin = mysql_fetch_assoc($report_admin);
$totalRows_report_admin = mysql_num_rows($report_admin);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_popular = "SELECT ts_peserta.ts_peserta_status, ts_kursus.ts_kursus_id,COUNT(ts_peserta_status), ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_bil_max FROM ts_peserta, ts_kursus WHERE ts_kursus.ts_kursus_id=ts_peserta.ts_peserta_status GROUP BY ts_peserta_status ORDER BY COUNT(ts_peserta_status) DESC";
$popular = mysql_query($query_popular, $ts_kursus) or die(mysql_error());
$row_popular = mysql_fetch_assoc($popular);
$totalRows_popular = mysql_num_rows($popular);
isset($startRow_popular)? $orderNum=$startRow_popular:$orderNum=0;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Laporan Kursus</title>
<link rel="stylesheet" type="text/css" href="../includes/table/style.css" />
</head>

<body>
	<div id="tablewrapper">
    <div id="tableheader">
    <p>
    <span>Laporan Kursus</span>
        <a href="javascript:window.print()" class="printer" title="Cetak">Cetak</a>
        <a href="#" class="excel" title="Export to CSV">CSV</a>
        <a href="#" class="pdf" title="Export to PDF">PDF</a>
        <br />
      <p>Berikut adalah laporan untuk keseluruhan kursus di bawah seliaan TS01 sepanjang tahun <?php echo date('Y'); ?>. </p>
      <h3>Jumlah Peserta</h3>
    </p>
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
      </div>
      <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
        <thead>
          <tr>
            <th><h3>Tajuk</h3></th>
            <th><h3>Berdaftar</h3></th>
            <th><h3>Kuota</h3></th>
            <th><h3>% berdaftar</h3></th>
          </tr>
        </thead>
        <tbody>
          <?php do { ?>
          <?php 
							$a = $row_popular['COUNT(ts_peserta_status)'];
							$b = $row_popular['ts_kursus_bil_max'];
							$total+= $a;
							$max+= $b;
							$percentage=($a/$b)*100;
							$avg=($total/$max)*100;
						?>
          <tr>
            <td><?php echo chop($row_popular['ts_kursus_nama']); ?></td>
            <td><?php echo $row_popular['COUNT(ts_peserta_status)']; ?></td>
            <td><?php echo $row_popular['ts_kursus_bil_max']; ?></td>
            <td><?php echo number_format($percentage,3); ?></td>
          </tr>
          <?php } while ($row_popular = mysql_fetch_assoc($popular)); ?>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
      <div id="tablefooter">
          <div id="tablenav">
            	<div>
                  <img src="../includes/table/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                  <img src="../includes/table/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                  <img src="../includes/table/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                  <img src="../includes/table/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
        </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
      </div>
</div>
	<script type="text/javascript" src="../includes/table/script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:10,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[1],
		avg:[3],
		columns:[{index:2, format:'$', decimals:1},{index:3, format:'%', decimals:3}],
		init:true
	});
  </script>
</body>
</html>
<?php
mysql_free_result($count_kursus);
mysql_free_result($count_penaja);
mysql_free_result($report_admin);
mysql_free_result($popular);
?>