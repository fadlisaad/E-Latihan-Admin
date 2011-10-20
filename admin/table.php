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
$query_list_kursus = "SELECT * FROM ts_kursus";
$list_kursus = mysql_query($query_list_kursus, $ts_kursus) or die(mysql_error());
$row_list_kursus = mysql_fetch_assoc($list_kursus);
$totalRows_list_kursus = mysql_num_rows($list_kursus);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Senarai Kursus</title>
<link rel="stylesheet" href="includes/table/style.css" />
</head>
<body>
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Rekod <span id="startrecord"></span>-<span id="endrecord"></span> dari <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
                <tr>
                    <th class="nosort"><h3>ID</h3></th>
                    <th><h3>Name</h3></th>
                    <th><h3>Kod</h3></th>
                    <th><h3>Kategori</h3></th>
                    <th><h3>Lokasi</h3></th>
                    <th><h3>Tarikh mula</h3></th>
                    <th><h3>Tarikh tamat</h3></th>
                    <th><h3>Tahun</h3></th>
                    <th><h3>Yuran</h3></th>
                    <th><h3>Score</h3></th>
                </tr>
            </thead>
            <tbody>
                <?php do { ?>
                  <tr>
                    <td><?php echo $row_list_kursus['ts_kursus_id']; ?></td>
                    <td><?php echo $row_list_kursus['ts_kursus_nama']; ?></td>
                    <td><?php echo $row_list_kursus['ts_kursus_kod']; ?></td>
                    <td><?php echo $row_list_kursus['ts_kursus_kategori']; ?></td>
                    <td><?php echo $row_list_kursus['ts_kursus_lokasi']; ?></td>
                    <td><?php echo $row_list_kursus['ts_kursus_tarikh_mula']; ?></td>
                    <td><?php echo $row_list_kursus['ts_kursus_tarikh_tamat']; ?></td>
                    <td><?php echo $row_list_kursus['ts_kursus_year']; ?></td>
                    <td><?php echo $row_list_kursus['ts_kursus_harga']; ?></td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php } while ($row_list_kursus = mysql_fetch_assoc($list_kursus)); ?>
            </tbody>
        </table>
    <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="includes/table/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="includes/table/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="includes/table/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="includes/table/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">Papar semua rekod</a>
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
                    <span>Rekod per paparan</span>
                </div>
                <div class="page">Halaman <span id="currentpage"></span> dari <span id="totalpages"></span></div>
            </div>
        </div>
    </div>
	<script type="text/javascript" src="includes/table/script.js"></script>
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
		size:5,
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
		avg:[9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	});
  </script>
</body>
</html>
<?php
mysql_free_result($list_kursus);
?>