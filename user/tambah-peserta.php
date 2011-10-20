<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, znasystem@apadmedia.com, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * Last update: 25 March 2010
 * 
 * Description : main script for checking user validity.
 */
	if(!isset($_GET['ts_kursus_id']))
	{
		die("What’s this document for?");
	}
	elseif(isset($_GET['ts_kursus_id']))
	{
    require('../login/config.php');
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
    
$user=stripslashes(strip_tags(htmlspecialchars($_GET['ts_kursus_id'], ENT_QUOTES)));
    $checkout=mysql_query("SELECT * FROM ts_kursus WHERE ts_kursus_id = ".$user."");
?>  

<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
<!--
pic1 = new Image(16, 16); 
pic1.src = "username_checker/loader.gif";

$(document).ready(function(){

$("#ic").change(function() { 

var usr = $("#ic").val();

if(usr.length >= 4)
{
$("#status").html('<img src="username_checker/loader.gif" align="absmiddle">&nbsp;Semakan No IC...');

    $.ajax({  
    type: "POST",  
    url: "username_checker/check.php",  
    data: "ic="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#ic").removeClass('object_error'); // if necessary
		$("#ic").addClass("object_ok");
		$(this).html('&nbsp;<img src="username_checker/tick.gif" align="absmiddle">');
		$("#daftar").show();
	}  
	else  
	{  
		$("#ic").removeClass('object_ok'); // if necessary
		$("#ic").addClass("object_error");
		$(this).html(msg);
		$("#daftar").hide();
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#status").html('<font color="red">The username should have at least <strong>4</strong> characters.</font>');
	$("#ic").removeClass('object_ok'); // if necessary
	$("#ic").addClass("object_error");
	}

});

});
//-->
</script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link type="text/css" rel="stylesheet" href="../files/common1.css">
<link type="text/css" rel="stylesheet" href="../files/master1.css">
<div id="signin_wrapper1">
<h3>Pendaftaran untuk kursus <?php echo $checkout['ts_kursus_nama']; ?></h3>
<p><span class="icon">&nbsp;</span>Ruangan bertanda (*) adalah wajib</p>
<form action="../../index.php?option=com_jumi&fileid=6&ts_kursus_id=<?php echo $_GET['ts_kursus_id']; ?>" method="POST" name="form" id="form">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="43%">Nama (seperti dalam kad pengenalan) *</td>
      <td width="2%">:</td>
      <td width="55%" colspan="2"><input name="name" type="text" id="name" tabindex="1" class="big_i" value="nama penuh anda" size="40" /></td>
    </tr>
    <tr>
      <td width="43%">No. IC/Passpot  *</td>
      <td width="2%">:</td>
      <td colspan="2"><input name="ic" type="text" id="ic" tabindex="2" value="no. IC / paspot" />
      <div id="status"></div>Warganegara (Contoh: 810909090909), Bukan Warganegara, <a href="passport.html" onclick="window.open('passport.html','CountryCode','scrollbars=yes,width=500,height=600')" target="_blank">sila klik disini</a></td>
    </tr>
    <tr>
      <td width="43%">Password *</td>
      <td width="2%">:</td>
      <td colspan="2"><input name="password" type="password" id="password" tabindex="3" value="******" /></td>
    </tr>
    <tr>
      <td width="43%">E-mail *</td>
      <td width="2%">:</td>
      <td colspan="2"><input name="email" type="text" id="email" tabindex="4" value="@" /></td>
    </tr>
    <tr>
      <td width="43%">Telefon bimbit *</td>
      <td width="2%">:</td>
      <td colspan="2"><input name="phone" type="text" id="phone" tabindex="5" value="+601" maxlength="12" /></td>
    </tr>
    <tr>
      <td>Telefon pejabat/rumah</td>
      <td>:</td>
      <td colspan="2"><input name="home" type="text" id="home" tabindex="5" value="+60" maxlength="12" /></td>
    </tr>
    <tr>
      <td width="43%" valign="top">Alamat Rumah</td>
      <td width="2%">:</td>
      <td colspan="2"><textarea name="address" cols="45" rows="5" tabindex="6" >- tiada -</textarea></td>
    </tr>
    <tr>
      <td>Umur</td>
      <td>:</td>
      <td colspan="2"><input name="umur" type="text" id="umur" value="00" size="3" maxlength="2" />
      tahun</td>
    </tr>
    <tr>
      <td>Jantina</td>
      <td>:</td>
      <td><input type="radio" name="jantina" id="perempuan" value="perempuan" /></td>
      <td>Perempuan</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="jantina" type="radio" id="lelaki" value="lelaki" checked="checked" /></td>
      <td>Lelaki</td>
    </tr>
    <tr>
      <td rowspan="3">Status</td>
      <td rowspan="3">:</td>
      <td><input name="status_perkahwinan" type="radio" id="bujang" value="bujang" checked="checked" /></td>
      <td>Bujang</td>
    </tr>
    <tr>
      <td><input type="radio" name="status_perkahwinan" id="berkahwin" value="berkahwin" /></td>
      <td>Berkahwin</td>
    </tr>
    <tr>
      <td><input type="radio" name="status_perkahwinan" id="ibu_tunggal" value="ibu tunngal" /></td>
      <td>Ibu tunggal</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Kelulusan akademik tertinggi</td>
      <td>:</td>
      <td colspan="2"><select name="pendidikan" id="pendidikan">
        <option value="tiada" selected="selected">- sila pilih -</option>
        <option value="pmr">SRP/PMR</option>
        <option value="spm">SPM</option>
        <option value="stpm">STPM</option>
        <option value="diploma">Diploma</option>
        <option value="sarjana muda">Ijazah Sarjana Muda</option>
        <option value="sarjana">Ijazah Sarjana</option>
        <option value="phd">PHD</option>
        <option value="tiada">Tiada</option>
      </select>      </td>
    </tr>
    <tr>
      <td>Pekerjaan sekarang</td>
      <td>:</td>
      <td colspan="2"><select name="pekerjaan" id="pekerjaan">
        <option value="tiada" selected="selected">- sila pilih -</option>
        <option value="mardi">MARDI</option>
        <option value="kerajaan">Agensi Kerajaan</option>
        <option value="usahawan">Usahawan</option>
        <option value="swasta">Swasta</option>
        <option value="antarabangsa">Antarabangsa</option>
        <option value="kerja sendiri">Bekerja sendiri/Awam</option>
      </select>      </td>
    </tr>
    <tr>
      <td>Perniagaan diusahakan sekarang (jika ada)</td>
      <td>:</td>
      <td colspan="2"><input name="perusahaan" type="text" id="perusahaan" value="- tiada -" /></td>
    </tr>
    <tr>
      <td>Majikan</td>
      <td>:</td>
      <td colspan="2"><input name="nama_majikan" type="text" id="nama_majikan" value="- tiada -" /></td>
    </tr>
    <tr>
      <td valign="top">Alamat Majikan</td>
      <td>:</td>
      <td colspan="2"><textarea name="alamat_majikan" id="alamat_majikan" cols="45" rows="5">- tiada -</textarea></td>
    </tr>
    <tr>
      <td>Telefon Majikan</td>
      <td>:</td>
      <td colspan="2"><input name="telefon_majikan" type="text" id="telefon_majikan" value="+60" maxlength="12" /></td>
    </tr>
  </table>
<?php echo $_GET['ts_kursus_id'];?>
  <div id="daftar" style="display:none"><input type="submit" name="daftar" class="butt" id="daftar" value="Hantar" /></div>
<input type="hidden" name="registerDate" id="registerDate" value="<?php echo date("d-m-Y"); ?>" />
    <input type="hidden" name="ts_kursus_id" id="ts_kursus_id" value="<?php echo $_GET['ts_kursus_id']; ?>" />
    <input type="hidden" name="year" id="year" value="<?php echo date("Y"); ?>" />
    <input type="hidden" name="status" value="1" />
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
    <input type="hidden" name="MM_insert" value="form" />
</form>
  <p class="bottom">Hakcipta Terpelihara &copy; 2009-2010 e-Latihan, MARDI</p>
</div>
<?php } // End ElseIf.
?>