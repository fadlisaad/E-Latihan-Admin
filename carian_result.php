<?php require_once('Connections/ts_kursus.php'); ?>
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

$colname_search = "-1";
if (isset($_POST['keyword'])) {
  $colname_search = $_POST['keyword'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_search = sprintf("SELECT * FROM ts_kursus WHERE ts_kursus_nama LIKE %s", GetSQLValueString("%".$colname_search."%", "text"));
$search = mysql_query($query_search, $ts_kursus) or die(mysql_error());
$row_search = mysql_fetch_assoc($search);
$totalRows_search = mysql_num_rows($search);
isset($startRow_search)? $orderNum=$startRow_search:$orderNum=0;
?>
<h3>Keputusan Carian</h3>
                
                <?php if ($totalRows_search == 0) { // Show if recordset empty ?>
                <p class="message"><span class="icon">&nbsp;</span>Tiada keputusan bagi kata kunci '<?php echo $_POST['keyword'] ?>'.</p>
                <form action="index.php?option=com_jumi&amp;fileid=10" method="POST" name="form">
    <label for="keyword">Tajuk kursus :</label>
    <input name="keyword" id="keyword" type="text" tabindex="1" />
    <input name="submit" type="submit" id="button1" value="Cari" />
    </form>
	<p class="message"><span class="icon">&nbsp;</span>Cuba carian khas menggunakan Google</p>
	<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load('search', '1', {language : 'en'});
  google.setOnLoadCallback(function(){
    var customSearchControl = new google.search.CustomSearchControl('005690580677692968662:gsa1mbgxykq');
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    customSearchControl.draw('cse');
  }, true);
</script>
<link rel="stylesheet" href="http://www.google.com/cse/style/look/default.css" type="text/css" />

                  <?php } // Show if recordset empty ?>
                <?php if ($totalRows_search > 0) { // Show if recordset not empty ?>
  <table width="100%">
                    <thead>
                      <tr>
                        <th width="40">Bil</th>
                        <th>Tajuk Kursus</th>
                        <th>Tarikh</th>
                        <th>Harga</th>
                      </tr>
                      </thead>
                    <tbody>
                      <?php do { ?>
                      <tr>
                        <td><?php echo ++$orderNum; ?></td>
                        <td><a href="index.php?option=com_jumi&fileid=4&ts_kursus_id=<?php echo $row_search['ts_kursus_id']; ?>"><?php echo $row_search['ts_kursus_nama']; ?></a></td>
                        <td nowrap><?php
							if ($row_search['ts_kursus_tarikh_mula'] == '0000-00-00')
							echo "Belum ditentukan";
							else echo date("d/m/Y",strtotime($row_search['ts_kursus_tarikh_mula'])); ?>
							<?php
							if ($row_search['ts_kursus_tarikh_tamat'] == '0000-00-00')
							echo "&nbsp;";
							else echo "&nbsp;hingga&nbsp;".date("d/m/Y",strtotime($row_search['ts_kursus_tarikh_tamat'])).""; ?></td>
                        <td nowrap>RM <?php echo $row_search['ts_kursus_harga']; ?></td>
                      </tr>
                        <?php } while ($row_search = mysql_fetch_assoc($search)); ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                  <?php } // Show if recordset not empty ?>
</div>
             
<?php
mysql_free_result($search);
?>
