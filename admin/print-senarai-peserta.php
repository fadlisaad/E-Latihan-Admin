<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * Update by: Jourdien
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Cetak senarai peserta.
 */
	//Include database connection details
	require_once '../login/config.php';
	
	//Include session
	require_once '../login/auth.php';
	
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
	
	if (isset($_GET['id'])) {

		$kursus_id	= $_GET['id'];
		$numbering	= 1;
		
		$printSQL = "SELECT ts_peserta.ts_peserta_nama nama, ts_peserta.ts_peserta_ic ic, ts_peserta.ts_peserta_alamat alamat, ts_peserta.ts_peserta_handfone telefon, ts_peserta.ts_peserta_email email FROM ts_peserta JOIN ts_invoice ON ts_peserta.ts_peserta_ID = ts_invoice.peserta_id WHERE ts_invoice.kursus_id = $kursus_id";
		$query = mysql_query($printSQL) or die(mysql_error());
		
		$kursusSQL = "SELECT * FROM ts_kursus WHERE ts_kursus_id = $kursus_id";
		$querykursus = mysql_query($kursusSQL) or die(mysql_error());
		$kursus = mysql_fetch_assoc($querykursus);
		//print_r($kursus);die;
		
		require_once('../tcpdf/config/lang/eng.php');
		require_once('../tcpdf/tcpdf.php');

		// create new PDF document
		$pdf = new TCPDF('landscape', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('e-latihan');
		$pdf->SetTitle('Senarai Peserta dalam kursus '.strtoupper($printSQL['kursus']).'');
		$pdf->SetSubject('Program Kursus dan Latihan Teknikal, MARDI');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

		//set some language-dependent strings
		$pdf->setLanguageArray($l); 

		// add a page
		$pdf->AddPage();

		// create some HTML content
		$htmlcontent = '<h2>'.$kursus['ts_kursus_nama'].'('.$kursus['ts_kursus_kod'].')</h2>';
		$htmlcontent .= '<p><ul><li>Kategori:'.$kursus['ts_kursus_kategori'].'</li><li>Lokasi:'.$kursus['ts_kursus_lokasi'].'</li><li>Yuran:RM'.$kursus['ts_kursus_harga'].'</li><li>Tarikh:'.$kursus['ts_kursus_tarikh_mula'].' hingga'.$kursus['ts_kursus_tarikh_tamat'].'</li><li>Tahun:'.$kursus['ts_kursus_year'].'</li></ul></p>';
		$htmlcontent .= '<table width="1000px" border="1"><tr><th width="20px">Bil.</th><th>Nama</th><th>Alamat</th><th>Telefon</th><th>IC</th><th>E-mail</th></tr>';
			while ($row = mysql_fetch_assoc($query)) {
		$htmlcontent .= '<tr>';
		$htmlcontent .= '<td width="20px">'.$numbering++.'</td>';
		$htmlcontent .= '<td>'.strtoupper($row['nama']).'</td>';
		$htmlcontent .= '<td>'.strtoupper($row['alamat']).'</td>';
		$htmlcontent .= '<td>'.$row['telefon'].'</td>';
		$htmlcontent .= '<td>'.$row['ic'].'</td>';
		$htmlcontent .= '<td>'.$row['email'].'</td>';
		$htmlcontent .= '</tr>';
				}
		$htmlcontent .= '</table>';
		
		// output the HTML content
		$pdf->writeHTML($htmlcontent, true, 0, true, 0);

		//Close and output PDF document
		$pdf->Output('senarai-peserta-'.strtoupper($printSQL['kursus']).'.pdf', 'I');

		mysql_free_result($printSQL);
	}
?>