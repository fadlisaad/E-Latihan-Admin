<?php require_once('../login/auth.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) {
  $updateSQL = sprintf("UPDATE ts_peserta SET ts_peserta_handfone=%s, ts_peserta_homeline=%s, ts_peserta_alamat=%s, ts_peserta_email=%s, ts_peserta_perkahwinan=%s, ts_peserta_pendidikan=%s, ts_peserta_pekerjaan=%s, ts_peserta_perusahaan=%s, ts_majikan_nama=%s, ts_majikan_alamat=%s, ts_majikan_telefon=%s WHERE ts_peserta_ic=%s",
                       GetSQLValueString($_POST['handphone'], "text"),
                       GetSQLValueString($_POST['homeline'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['taraf'], "text"),
                       GetSQLValueString($_POST['pendidikan'], "text"),
                       GetSQLValueString($_POST['pekerjaan'], "text"),
                       GetSQLValueString($_POST['perusahaan'], "text"),
                       GetSQLValueString($_POST['m_nama'], "text"),
                       GetSQLValueString($_POST['m_alamat'], "text"),
                       GetSQLValueString($_POST['m_telefon'], "text"),
                       GetSQLValueString($_POST['ic'], "text"));

  mysql_select_db($database_ts_kursus, $ts_kursus);
  $Result1 = mysql_query($updateSQL, $ts_kursus) or die(mysql_error());

  $updateGoTo = "user-page.php?ts_peserta_ID=" . $_GET['id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_user_details = "-1";
if (isset($_GET['id'])) {
  $colname_user_details = $_GET['id'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_user_details = sprintf("SELECT * FROM ts_peserta WHERE ts_peserta.ts_peserta_ID=%s", GetSQLValueString($colname_user_details, "int"));
$user_details = mysql_query($query_user_details, $ts_kursus) or die(mysql_error());
$row_user_details = mysql_fetch_assoc($user_details);
$totalRows_user_details = mysql_num_rows($user_details);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="en" />
<meta name="robots" content="noindex,nofollow" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/reset.css" />
<!-- RESET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/main.css" />
<!-- MAIN STYLE SHEET -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/2col.css" title="2col" />
<!-- DEFAULT: 2 COLUMNS -->
<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../css/1col.css" title="1col" />
<!-- ALTERNATE: 1 COLUMN -->
<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]-->
<!-- MSIE6 -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/style.css" />
<!-- GRAPHIC THEME -->
<link rel="stylesheet" media="screen,projection" type="text/css" href="../css/mystyle.css" />
<!-- WRITE YOUR CSS CODE HERE -->
<script type="text/javascript">

function FDK_AddToValidateArray(FormName,FormElement,Validation,SetFocus)
{
    var TheRoot=eval("document."+FormName);
 
    if (!TheRoot.ValidateForm) 
    {
        TheRoot.ValidateForm = true;
        eval(FormName+"NameArray = new Array()")
        eval(FormName+"ValidationArray = new Array()")
        eval(FormName+"FocusArray = new Array()")
    }
    var ArrayIndex = eval(FormName+"NameArray.length");
    eval(FormName+"NameArray[ArrayIndex] = FormElement");
    eval(FormName+"ValidationArray[ArrayIndex] = Validation");
    eval(FormName+"FocusArray[ArrayIndex] = SetFocus");
 
}

function FDK_ValidateSelectionMade(FormElement,ErrorMsg)
{
  msg = "";

  var iPos = FormElement.selectedIndex;
  if ((iPos<=0 && FormElement.size<=1) || (iPos<0))
  {
    msg = ErrorMsg;
  }

  return msg;
}

function FDK_AddSelectionMadeValidation(FormName,FormElementName,SetFocus,ErrorMsg)  {
  var ValString = "FDK_ValidateSelectionMade("+FormElementName+","+ErrorMsg+")"
  FDK_AddToValidateArray(FormName,eval(FormElementName),ValString,SetFocus)
}
</script>

<title>Ubah Maklumat</title>
</head>
<body>

<div id="main">
	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
				<a href="#" class="styleswitch ico-col1" title="Display one column"><img src="../design/switcher-1col.gif" alt="1 Column" /></a>
			E-Latihan: <strong>Halaman Pengguna</strong></p>

	  <p class="f-right"><?php echo ucwords($_SESSION['SESS_FULLNAME']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="logout.php" id="logout">Log keluar</a></strong></p>
  </div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	
	<div id="menu" class="box">
    </div>
	
	<!-- /header -->

<hr class="noscreen" />

	<!-- Columns -->
  <div id="cols" class="box">

		<!-- Aside (Left Column) -->
	<!-- /aside -->

  <hr class="noscreen" />

	  <!-- Content (Right Column) -->   
 
    <div id="content">
    <form method="POST" action="<?php echo $editFormAction; ?>" name="update" id="update">
    <h3>
      <input type="hidden" name="ic" id="ic" value="<?php echo $row_user_details['ts_peserta_ic']; ?>"/>
      Selamat datang, <?php echo ucwords($_SESSION['SESS_FULLNAME']);?></h3>
	  <h4>Ubah maklumat peribadi dan biodata</h4>
	  <div id="tab03">
  <div class="col50">
  <fieldset> 
    <legend>Maklumat Peribadi</legend>
    
      <table width="100%" class="nostyle">
      <tr>
        <td width="150">Nama Penuh</td>
        <td><?php echo strtoupper($row_user_details['ts_peserta_nama']); ?></td>
      </tr>
      <tr>
        <td width="150">No. IC/Passport</td>
        <td><?php echo $row_user_details['ts_peserta_ic']; ?></td>
      </tr>
      <tr>
        <td width="150">Jantina</td>
        <td><?php echo strtoupper($row_user_details['ts_peserta_jantina']); ?></td>
      </tr>
      <tr>
        <td width="150">Umur</td>
        <td><?php echo $row_user_details['ts_peserta_umur']; ?></td>
      </tr>
    </table>
  </fieldset>
  </div>
  <div class="col50 f-right">
  <fieldset> 
    <legend>Maklumat Untuk Dihubungi</legend>
    <table width="100%" class="nostyle">
      <tr>
        <td width="150">No. Telefon Bimbit</td>
        <td><input name="handphone" type="text" class="input-text" id="handphone" value="<?php echo $row_user_details['ts_peserta_handfone']; ?>"/>
          </td>
      </tr>
      <tr>
        <td width="150">No.Telefon Rumah</td>
        <td><input name="homeline" type="text" class="input-text" id="homeline" value="<?php echo $row_user_details['ts_peserta_homeline']; ?>" />
          </td>
      </tr>
      <tr>
        <td width="150"><label for="label">Alamat Rumah</label></td>
        <td><textarea name="address" cols="40" rows="5" class="input-text" id="address"><?php echo strtoupper($row_user_details['ts_peserta_alamat']); ?></textarea>
          </td>
      </tr>
      <tr>
        <td width="150"><label for="label">E-mail</label></td>
        <td><input name="email" type="text" class="input-text" id="email" value="<?php echo $row_user_details['ts_peserta_email']; ?>" />
          </td>
      </tr>
    </table>
      </fieldset>
      </div>
      <div class="fix"></div>
      <div class="col50">
      <fieldset> 
        <legend>Maklumat Lain</legend>
        <table width="100%" class="nostyle">
  <tr>
    <td width="150"><label>Taraf Perkahwinan</label></td>
    <td><input <?php if (!(strcmp($row_user_details['ts_peserta_perkahwinan'],"bujang"))) {echo "checked=\"checked\"";} ?> type="radio" name="taraf" id="taraf" value="bujang" />
      Bujang<br />
          <input <?php if (!(strcmp($row_user_details['ts_peserta_perkahwinan'],"kahwin"))) {echo "checked=\"checked\"";} ?> type="radio" name="taraf" id="taraf" value="kahwin" />
            Berkahwin<br />
                <input <?php if (!(strcmp($row_user_details['ts_peserta_perkahwinan'],"janda"))) {echo "checked=\"checked\"";} ?> type="radio" name="taraf" id="taraf" value="janda" />
              Ibu tunggal</td>
  </tr>
  <tr>
    <td width="150">Pendidikan</td>
    <td><select name="pendidikan" class="input-text" id="pendidikan" onchange="FDK_AddSelectionMadeValidation('undefined','document.undefined.undefined',true,'\'Ruangan ini adalah wajib, jika tiada sila pilih -Tiada-\'')">
      <option value="tiada" selected="selected" <?php if (!(strcmp("tiada", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>- sila pilih -</option>
<option value="pmr" <?php if (!(strcmp("pmr", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>SRP/PMR</option>
      <option value="spm" <?php if (!(strcmp("spm", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>SPM</option>
      <option value="stpm" <?php if (!(strcmp("stpm", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>STPM</option>
      <option value="diploma" <?php if (!(strcmp("diploma", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>Diploma</option>
      <option value="sarjana muda" <?php if (!(strcmp("sarjana muda", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>Ijazah Sarjana Muda</option>
      <option value="sarjana" <?php if (!(strcmp("sarjana", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>Ijazah Sarjana</option>
      <option value="phd" <?php if (!(strcmp("phd", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>PHD</option>
      <option value="tiada" <?php if (!(strcmp("tiada", $row_user_details['ts_peserta_pendidikan']))) {echo "selected=\"selected\"";} ?>>Tiada</option>
    </select></td>
  </tr>
  <tr>
    <td width="150"><label>Pekerjaan</label></td>
    <td><select name="pekerjaan" class="input-text" id="pekerjaan" onchange="FDK_AddSelectionMadeValidation('undefined','document.undefined.undefined',true,'\'Ruangan ini adalah wajib, jika tiada sila pilih -Tiada-\'')">
      <option value="tiada" selected="selected" <?php if (!(strcmp("tiada", $row_user_details['ts_peserta_pekerjaan']))) {echo "selected=\"selected\"";} ?>>- sila pilih -</option>
      <option value="mardi" <?php if (!(strcmp("mardi", $row_user_details['ts_peserta_pekerjaan']))) {echo "selected=\"selected\"";} ?>>MARDI</option>
      <option value="kerajaan" <?php if (!(strcmp("kerajaan", $row_user_details['ts_peserta_pekerjaan']))) {echo "selected=\"selected\"";} ?>>Agensi Kerajaan</option>
      <option value="usahawan" <?php if (!(strcmp("usahawan", $row_user_details['ts_peserta_pekerjaan']))) {echo "selected=\"selected\"";} ?>>Usahawan</option>
      <option value="swasta" <?php if (!(strcmp("swasta", $row_user_details['ts_peserta_pekerjaan']))) {echo "selected=\"selected\"";} ?>>Swasta</option>
      <option value="antarabangsa" <?php if (!(strcmp("antarabangsa", $row_user_details['ts_peserta_pekerjaan']))) {echo "selected=\"selected\"";} ?>>Antarabangsa</option>
      <option value="kerja sendiri" <?php if (!(strcmp("kerja sendiri", $row_user_details['ts_peserta_pekerjaan']))) {echo "selected=\"selected\"";} ?>>Bekerja sendiri/Awam</option>
    </select>      </td>
  </tr>
  <tr>
    <td width="150">Bidang</td>
    <td><input name="perusahaan" type="text" class="input-text" id="perusahaan" value="<?php echo strtoupper($row_user_details['ts_peserta_perusahaan']); ?>" />      </td>
  </tr>
</table>
</fieldset>
</div>
<div class="col50 f-right">
  <fieldset> 
    <legend>Maklumat Majikan</legend>
    <table width="100%" class="nostyle">
  <tr>
    <td width="150"><label>Majikan</label></td>
    <td><input name="m_nama" type="text" class="input-text" id="m_nama" value="<?php echo strtoupper($row_user_details['ts_majikan_nama']); ?>" />
      </td>
  </tr>
  <tr>
    <td width="150"><label>Alamat</label></td>
    <td><textarea name="m_alamat" cols="40" rows="5" class="input-text" id="m_alamat"><?php echo strtoupper($row_user_details['ts_majikan_alamat']); ?></textarea>
      </td>
  </tr>
  <tr>
    <td width="150"><label>No. Telefon</label></td>
    <td><input name="m_telefon" type="text" class="input-text" id="m_telefon" value="<?php echo $row_user_details['ts_majikan_telefon']; ?>" />
      </td>
  </tr>
</table>
<div class="fix"></div>

</fieldset>
<div id="pager"><div class="buttons">
   <button type="submit">
   <img src="../admin/img/icons/disk.png" alt=""/>Simpan</button>
   <button type="reset">
   <img src="../admin/img/icons/cross.png" alt=""/>Batal</button>
</div>
</div>
</div>
<div class="fix"></div>
<p>Sila pastikan segala maklumat yang telah dimasukkan adalah tepat. Klik pada butang 'Kemaskini' untuk simpan maklumat</p>
  </div>
  <!-- /tab closed -->
  <input type="hidden" name="MM_update" value="update" />
  </form>
    </div>
	<!-- /content -->

	<hr class="noscreen" />

	<!-- Footer -->
	
	<div id="footer" class="box">
      <p class="f-left"><span class="t-left">&copy; 2010 Hakcipta Terpelihara E-Latihan</span></p>
      <p class="f-right"><span class="t-left">Program Kursus dan Latihan Teknikal, Pusat Perkhidmatan Teknikal, MARDI</span></p>
	  </div>
  
	<!-- /footer -->
</div> 
<!-- /main -->
</div>
</body>
</html>
<?php
mysql_free_result($user_details);
?>