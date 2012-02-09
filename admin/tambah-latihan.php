<?php 
	require_once('../Connections/ts_kursus.php');
	require_once('../login/auth.php');
	
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO ts_latihan (ts_latihan_nama, ts_latihan_kod, ts_latihan_kategori, ts_latihan_keterangan, ts_latihan_lokasi, ts_latihan_tarikh_mula, ts_latihan_tarikh_tamat, ts_latihan_harga, ts_latihan_vendor, ts_latihan_admin, ts_latihan_bil_min, ts_latihan_bil_max, ts_latihan_year, ts_latihan_pubdate, ts_latihan_jadual) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['latihan_nama'], "text"),
                       GetSQLValueString($_POST['latihan_kod'], "text"),
                       GetSQLValueString($_POST['latihan_kategori'], "text"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['latihan_lokasi2'], "text"),
                       GetSQLValueString($_POST['tarikh_mula'], "text"),
                       GetSQLValueString($_POST['tarikh_tamat'], "text"),
                       GetSQLValueString($_POST['latihan_harga'], "int"),
                       GetSQLValueString($_POST['latihan_vendor'], "text"),
                       GetSQLValueString($_POST['ts_admin'], "text"),
                       GetSQLValueString($_POST['latihan_min'], "int"),
                       GetSQLValueString($_POST['latihan_max'], "int"),
                       GetSQLValueString($_POST['tahun'], "int"),
                       GetSQLValueString($_POST['tarikh_tutup'], "text"),
                       GetSQLValueString($_POST['tarikh_papar'], "date"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($insertSQL, $ts_kursus) or die(mysql_error());

  $insertGoTo = "list-latihan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_kategori = "SELECT * FROM ts_kategori";
$kursus_kategori = mysql_query($query_kursus_kategori, $ts_kursus) or die(mysql_error());
$row_kursus_kategori = mysql_fetch_assoc($kursus_kategori);
$totalRows_kursus_kategori = mysql_num_rows($kursus_kategori);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_vendor = "SELECT kursus_vendor_ID, kursus_vendor_nama FROM ts_vendor";
$kursus_vendor = mysql_query($query_kursus_vendor, $ts_kursus) or die(mysql_error());
$row_kursus_vendor = mysql_fetch_assoc($kursus_vendor);
$totalRows_kursus_vendor = mysql_num_rows($kursus_vendor);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_lokasi = "SELECT ts_tempat_ID, ts_tempat_nama FROM ts_tempat_kursus ORDER BY ts_tempat_nama";
$kursus_lokasi = mysql_query($query_kursus_lokasi, $ts_kursus) or die(mysql_error());
$row_kursus_lokasi = mysql_fetch_assoc($kursus_lokasi);
$totalRows_kursus_lokasi = mysql_num_rows($kursus_lokasi);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_kursus_tambah = "SELECT * FROM ts_latihan";
$kursus_tambah = mysql_query($query_kursus_tambah, $ts_kursus) or die(mysql_error());
$row_kursus_tambah = mysql_fetch_assoc($kursus_tambah);
$totalRows_kursus_tambah = mysql_num_rows($kursus_tambah);

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_admin = "SELECT ts_admin_ID, ts_admin.ts_admin_nama FROM ts_admin ";
$admin = mysql_query($query_admin, $ts_kursus) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php include('meta.php'); ?>
<title>Tambah latihan</title>
<script type="text/javascript" src="../js/datepicker.js"></script>
<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
	mode : "textareas",
	theme : "simple",
	});
</script>
<script type="text/javascript">
<!--
/*
Credits: Bit Repository
Source: http://www.bitrepository.com/web-programming/ajax/username-checker.html 
*/

pic1 = new Image(16, 16); 
pic1.src = "check-username/loader.gif";

$(document).ready(function(){

$("#kursus_kod").change(function() { 

var usr = $("#kursus_kod").val();

if(usr.length >= 4)
{
$("#status").html('<img src="check-username/loader.gif" align="absmiddle">&nbsp;Semakan kod latihan...');

    $.ajax({  
    type: "POST",  
    url: "check-username/check-latihan.php",  
    data: "kursus_kod="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#kursus_kod").removeClass('object_error'); // if necessary
		$("#kursus_kod").addClass("object_ok");
		$(this).html('&nbsp;<img src="check-username/tick.gif" align="absmiddle">');
		$("#pager").show();
	}  
	else  
	{  
		$("#kursus_kod").removeClass('object_ok'); // if necessary
		$("#kursus_kod").addClass("object_error");
		$(this).html(msg);
		$("#pager").hide();
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#status").html('<font color="red">Kod yang dimasukkan telah ada dalam database. Sila pastikan samada latihan ini ialah latihan berjadual atau latihan luar jadual.</font>');
	$("#kursus_kod").removeClass('object_ok'); // if necessary
	$("#kursus_kod").addClass("object_error");
	}

});

});

//-->
</script>
</head>
<body>
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
              <h3>Penyelaras:&nbsp;<?php echo $_SESSION['SESS_FULLNAME'];?> | Tambah latihan </h3>
              <form name="form1" action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" id="form">
                <fieldset>
                  <legend>Keterangan latihan </legend>
                  <table width="100%" class="nostyle">
                    <tr>
                      <td width="15%">Tajuk latihan</td>
                      <td><input name="latihan_nama" type="text" class="input-text" id="latihan_nama" size="80" /></td>
                    </tr>
                    <tr>
                      <td width="15%">Kod latihan</td>
                      <td><input name="latihan_kod" type="text" class="input-text" id="latihan_kod" size="15" />&nbsp;<span id="status"></span></td>
                    </tr>
					<tr>
                      <td width="15%">Tahun</td>
                      <td><input name="tahun" type="text" class="input-text" id="tahun" size="15" /></td>
                    </tr>
					<tr>
                      <td width="15%">Tahun</td>
                      <td><input name="tahun" type="text" class="input-text" id="tahun" size="5" value="<?php echo date('Y'); ?>"/></td>
                    </tr>
                    <tr>
                      <td width="15%">Kluster</td>
                      <td><select name="latihan_kategori" class="input-text" id="latihan_kategori">
                        <option value="tiada" <?php if (!(strcmp("tiada", $row_kursus_kategori['ts_kategori_nama']))) {
					echo "selected=\"selected\"";} ?> <?php if (!(strcmp("tiada", $row_kursus_kategori['ts_kategori_nama']))) {echo "selected=\"selected\"";} ?>>- Sila Pilih -</option>
                        <?php
do {  
?><option value="<?php echo $row_kursus_kategori['ts_kategori_nama']?>"<?php if (!(strcmp($row_kursus_kategori['ts_kategori_nama'], $row_kursus_kategori['ts_kategori_nama']))) {echo "selected=\"selected\"";} ?>><?php echo $row_kursus_kategori['ts_kategori_nama']?></option>
                        <?php
} while ($row_kursus_kategori = mysql_fetch_assoc($kursus_kategori));
  $rows = mysql_num_rows($kursus_kategori);
  if($rows > 0) {
      mysql_data_seek($kursus_kategori, 0);
	  $row_kursus_kategori = mysql_fetch_assoc($kursus_kategori);
  }
?>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="15%">Jenis latihan</td>
                      <td><select name="latihan_vendor" class="input-text" id="latihan_vendor">
                        <option value="tiada" <?php if (!(strcmp("tiada", $row_kursus_vendor['kursus_vendor_nama']))) {
					echo "selected=\"selected\"";} ?> <?php if (!(strcmp("tiada", $row_kursus_vendor['kursus_vendor_nama']))) {echo "selected=\"selected\"";} ?>>- Sila Pilih -</option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_kursus_vendor['kursus_vendor_nama']?>"<?php if (!(strcmp($row_kursus_vendor['kursus_vendor_nama'], $row_kursus_vendor['kursus_vendor_nama']))) {echo "selected=\"selected\"";} ?>><?php echo $row_kursus_vendor['kursus_vendor_nama']?></option>
                        <?php
} while ($row_kursus_vendor = mysql_fetch_assoc($kursus_vendor));
  $rows = mysql_num_rows($kursus_vendor);
  if($rows > 0) {
      mysql_data_seek($kursus_vendor, 0);
	  $row_kursus_vendor = mysql_fetch_assoc($kursus_vendor);
  }
?>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="15%">Lokasi latihan</td>
                      <td><select name="latihan_lokasi2" class="input-text" id="kursus_lokasi2">
                        <option value="tiada" <?php if (!(strcmp("tiada", strtoupper($row_kursus_lokasi['ts_tempat_nama'])))) {echo "selected=\"selected\"";} ?>>- Sila Pilih -</option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_kursus_lokasi['ts_tempat_nama']?>"<?php if (!(strcmp($row_kursus_lokasi['ts_tempat_nama'], $row_kursus_lokasi['ts_tempat_nama']))) {echo "selected=\"selected\"";} ?>><?php echo strtoupper($row_kursus_lokasi['ts_tempat_nama']); ?></option>
                        <?php
} while ($row_kursus_lokasi = mysql_fetch_assoc($kursus_lokasi));
  $rows = mysql_num_rows($kursus_lokasi);
  if($rows > 0) {
      mysql_data_seek($kursus_lokasi, 0);
	  $row_kursus_lokasi = mysql_fetch_assoc($kursus_lokasi);
  }
?>
                      </select></td>
                    </tr>
                    <tr>
                      <td width="15%">Yuran (RM)</td>
                      <td><input name="latihan_harga" type="text" class="input-text" id="latihan_harga" /></td>
                    </tr>
                  </table>
                </fieldset>
			    <fieldset>
		        <legend>Tarikh</legend>
                <table width="100%" class="nostyle">
                  <tr>
                    <td width="15%">Tarikh Mula</td>
                    <td><input name="tarikh_mula" type="text" class="input-text" id="tarikh_mula" size="15" />
					  <script type="text/javascript">
					  // <![CDATA[       
						var opts = { formElements:{"tarikh_mula":"Y-ds-m-ds-d"} };        
						datePickerController.createDatePicker(opts);
					  // ]]>
					  </script></td>
                  </tr>
                  <tr>
                    <td width="15%">Tarikh Tamat</td>
                    <td><input name="tarikh_tamat" type="text" class="input-text" id="tarikh_tamat" size="15" />
					  <script type="text/javascript">
					  // <![CDATA[       
						var opts = { formElements:{"tarikh_tamat":"Y-ds-m-ds-d"} };        
						datePickerController.createDatePicker(opts);
					  // ]]>
					  </script></td>
                  </tr>
                  <tr>
                    <td>Tarikh tutup permohonan</td>
                    <td><input name="tarikh_tutup" type="text" class="input-text" id="tarikh_tutup" size="15" />
				    <script type="text/javascript">
					  // <![CDATA[       
						var opts = { formElements:{"tarikh_tutup":"Y-ds-m-ds-d"} };        
						datePickerController.createDatePicker(opts);
					  // ]]>
					  </script></td>
                  </tr>
                  <tr>
                    <td width="15%">Tarikh paparan</td>
                    <td><input name="tarikh_papar" type="text" class="input-text" id="tarikh_papar" size="15" />
					  <script type="text/javascript">
					  // <![CDATA[       
						var opts = { formElements:{"tarikh_papar":"Y-ds-m-ds-d"} };        
						datePickerController.createDatePicker(opts);
					  // ]]>
					  </script>
                      <br />
                    <p class="msg info">Pastikan tarikh paparan sekurang-kurangnya 1 bulan dari tarikh latihan</p></td>
                  </tr>
                </table>

		        </fieldset>
				  
				<fieldset id="personal">
			    <legend>Kehadiran</legend>
                <table width="100%" class="nostyle">
                  <tr>
                    <td width="15%">Maksimum</td>
                    <td><input name="latihan_max" type="text" class="input-text" id="latihan_max" size="5" />
                    peserta</td>
                  </tr>
                  <tr>
                    <td width="15%">Minimum</td>
                    <td><input name="latihan_min" type="text" class="input-text" id="latihan_min" size="5" />
                    peserta</td>
                  </tr>
                </table>

			    </fieldset>
				  
				<fieldset id="personal">
			    <legend>Lain-lain</legend>
                <table width="100%" class="nostyle">
                  <tr>
                    <td width="15%" class="va-top">Keterangan / Sinopsis</td>
                    <td><textarea name="keterangan" cols="30" rows="7" id="keterangan" class="wysiwyg"></textarea> 
                   <p class="msg error">Nota: Jangan 'Copy and paste' dari Microsoft Word. Sila copy ke 'Notepad' dan kemudian 'paste' disini. Ubah keterangan dengan menggunakan format (bold, bullet, numbering) yang disediakan</p></td>
                  </tr>
                </table>
			    <input name="ts_admin" type="hidden" id="ts_admin" value="<?php echo $_SESSION['SESS_ADMIN_ID']; ?>" />
			    </fieldset>
			    <div id="pager">
			      <?php include "includes/button.html"; ?>
		        </div>
               <input type="hidden" name="MM_insert" value="form1">
                   </form>
                    <div id="box">
                      <input name="ts_admin_ID" type="hidden" id="ts_admin_ID" value="<?php echo $_GET['ts_admin_ID']; ?>" />
                      
                      <label for="latihan_nama"></label>
                      <br />
                      <label></label>
              </div>
            </div>
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
mysql_free_result($kursus_kategori);
mysql_free_result($kursus_lokasi);
mysql_free_result($kursus_tambah);
mysql_free_result($admin);
mysql_free_result($kursus_vendor);
?>
