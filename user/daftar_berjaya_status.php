<?php
	ini_set("display_errors", 0);
	if(isset($_POST['sah']))
	{
	// Make a MySQL Connection
	mysql_connect("202.190.32.26", "root", "xs2mysql") or die(mysql_error());
	mysql_select_db("mardilms") or die(mysql_error());
	
	$email=$_POST['e-mail'];
	$password=$_POST['password'];
	$nama=$_POST['nama'];
	$ic=$_POST['ic'];
	$handphone=$_POST['handphone'];
	$homeline=$_POST['homeline'];
	$alamat=$_POST['alamat'];
	$umur=$_POST['umur'];
	$jantina=$_POST['jantina'];
	$perkahwinan=$_POST['perkahwinan'];
	$pendidikan=$_POST['pendidikan'];
	$pekerjaan=$_POST['pekerjaan'];
	$perusahaan=$_POST['perusahaan'];
	$m_nama=$_POST['m_nama'];
	$m_alamat=$_POST['m_alamat'];
	$m_telefon=$_POST['m_telefon'];
	$register=$_POST['register'];
	$tajuk=$_POST['tajuk'];
	$kod=$_POST['kod'];
	$kategori=$_POST['kategori'];
	$keterangan=$_POST['keterangan'];
	$lokasi=$_POST['lokasi'];
	$tarikh_mula=$_POST['tarikh_mula'];
	$tarikh_tamat=$_POST['tarikh_tamat'];
	$yuran=$_POST['yuran'];
	$invoice=$_POST['invoice'];
	$id=$_POST['id'];
	
	// Insert a row of information into the table "example"
	mysql_query("INSERT INTO ts_peserta (
		ts_peserta_nama, 
		ts_peserta_ic, 
		ts_peserta_handfone, 
		ts_peserta_homeline, 
		ts_peserta_alamat, 
		ts_peserta_email, 
		ts_peserta_umur, 
		ts_peserta_jantina, 
		ts_peserta_perkahwinan, 
		ts_peserta_pendidikan, 
		ts_peserta_pekerjaan, 
		ts_peserta_perusahaan, 
		ts_majikan_nama, 
		ts_majikan_alamat, 
		ts_majikan_telefon, 
		ts_peserta_register_date, 
		ts_peserta_password, 
		ts_peserta_status) VALUES('$nama',
		'$ic',
		'$handphone',
		'$homeline',
		'$alamat',
		'$email',
		'$umur',
		'$jantina',
		'$perkahwinan',
		'$pendidikan',
		'$pekerjaan',
		'$perusahaan',
		'$m_nama',
		'$m_alamat',
		'$m_telefon',
		'$register',
		'$password',
		'$id')") 
	or die(mysql_error());  
	
	$to = $email;
	$subject = "Pendaftaran untuk kursus ". $tajuk."";

	$message = "
	<html><body>
	<p>Assalamualaikum dan salam sejahtera ". $nama."</p>

	<p>Berikut adalah keterangan pendaftaran Tuan/Puan untuk kursus ".$tajuk."</p>
	<p>Tarikh Pendaftaran: ".date('d-m-Y')."<br>
	Kod: ".$kod."<br>
	Kategori: ".$kategori."<br>
	Sinopsis: ".strip_tags($keterangan)."<br>
	Lokasi: ".$lokasi."<br>
	Tarikh Mula: ".$tarikh_mula."<br>
	Tarikh Tamat: ".$tarikh_tamat."<br>
	Yuran: RM ".$yuran."<br>
	
	Nama: ".$nama."<br>
	Alamat: ".strip_tags($alamat)."<br>
	E-mail: ".$email."<br>
	Telefon Bimbit: ".$handphone."<br>
	Telefon Rumah: ".$homeline."<br>
	No Kad Pengenalan/Passport: ".$ic."<br>
	Umur: ".$umur."<br>
	Jantina: ".$jantina."<br>
	Taraf Perkahwinan: ".$perkahwinan."<br>
	Pendidikan: ".$pendidikan."<br>
	Pekerjaan sekarang: ".$pekerjaan."<br>
	Bidang: ".$perusahaan."<br>
	Nama Majikan: ".$m_nama."<br>
	Alamat Majikan: ".$m_alamat."<br>
	Telefon Majikan: ".$m_telefon."<br><br>
	
	ID Pengguna: ".$ic."<br>
	Password: ".$password."<br>
	Klik disini untuk mengesahkan pendaftaran Tuan/Puan : <a href='http://elearn.mardi.gov.my/ts/login-user/verify.php?ic=".$ic."&ts_kursus_id=".$id."'>http://elearn.mardi.gov.my/ts/login-user/verify.php?ic=".$ic."&id=".$id."</a><br>

	Untuk keterangan lanjut sila hubungi urusetia kursus di talian 03-89437238 (Program Kursus dan Latihan Teknikal).<br>
	Sekian.<br><br>
	b/p Timbalan Pengarah, Program Kursus dan Latihan Teknikal<br>
	Pusat Perkhidmatan Teknikal<br>
	Ibu Pejabat MARDI<br>
	Peti Surat 12301<br>
	50774 KUALA LUMPUR<br>
	Hakcipta terpelihara Program Kursus dan Latihan Teknikal untuk E-Latihan. Dijana oleh komputer. Tandatangan tidak diperlukan</p></body></html>";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n" . "CC: elatihan@mardi.gov.my";
	mail ($to,$subject,$message,$headers);

	echo "<p class=\"msg info\">Sila semak e-mail anda dan klik pada pautan yang telah dikepilkan bersama e-mail berkenaan untuk mengaktifkan pendaftarn anda.</p>";
	echo "<p>Pendaftaran anda dalam kursus ".$tajuk." telah berjaya dan akan diproses dalam masa terdekat. </p>";
	echo "<p>Status permohonan dan keterangan pendaftaran ini akan dihantar ke e-mail anda [".$email."]</p>";
	echo "<p>Anda boleh menyemak status permohonan anda dengan log masuk pada pautan 'Semak Permohonan | Semak Status Permohonan Anda'.</p>";
	echo "<h2>Bayaran</h2>";
	echo "<p>Untuk keterangan lanjut mengenai cara dan medium pembayaran, anda boleh merujuk kepada <a href=\"index.php?option=com_content&view=article&id=50\">halaman ini</a></p>";
	echo "<p><a href=\"http://www.cimbclicks.com.my/\"><img src=\"ts/images/cimb.gif\" alt=\"CIMB\" /></a></p>";
	echo "<p>Klik di sini untuk bayaran secara online menggunakan <a href=\"http://www.cimbclicks.com.my/\">CimbClikcs</a></p>";
	}
?>