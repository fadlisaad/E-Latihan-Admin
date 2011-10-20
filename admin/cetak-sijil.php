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

$colname_cetak_akuan = "-1";
if (isset($_GET['ts_kursus_id'])) {
  $colname_cetak_akuan = $_GET['ts_kursus_id'];
}
$colname2_cetak_akuan = "-1";
if (isset($_GET['ts_peserta_ID'])) {
  $colname2_cetak_akuan = $_GET['ts_peserta_ID'];
}
mysql_select_db($database_ts_kursus, $ts_kursus);
$query_cetak_akuan = sprintf("SELECT ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_lokasi, ts_kursus.ts_kursus_tarikh_mula, ts_kursus.ts_kursus_tarikh_tamat, ts_kursus.ts_kursus_harga, ts_kursus.ts_kursus_peta, ts_peserta.ts_peserta_nama, ts_peserta.ts_peserta_alamat, ts_kursus.ts_kursus_kod, ts_peserta.ts_peserta_ID FROM ts_kursus, ts_peserta, ts_invoice WHERE ts_kursus.ts_kursus_id = %s AND ts_peserta.ts_peserta_ID=%s AND ts_invoice.peserta_id=ts_peserta.ts_peserta_ID AND ts_invoice.kursus_id=ts_kursus.ts_kursus_id LIMIT 1", GetSQLValueString($colname_cetak_akuan, "int"),GetSQLValueString($colname2_cetak_akuan, "int"));
$cetak_akuan = mysql_query($query_cetak_akuan, $ts_kursus) or die(mysql_error());
$row_cetak_akuan = mysql_fetch_assoc($cetak_akuan);
$totalRows_cetak_akuan = mysql_num_rows($cetak_akuan);
?>
<?php

require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('e-latihan');
$pdf->SetTitle(''.strtoupper($row_cetak_akuan['ts_kursus_nama']).'');
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

// ---------------------------------------------------------

// set font
//$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

// create some HTML content
$htmlcontent = '<table width="500px">
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><p>No. Siri: '.date('Y').'/'.$row_cetak_akuan['ts_kursus_kod'].'/'.$row_cetak_akuan['ts_peserta_ID'].'</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td width="10px">&nbsp;</td>
  </tr>
    <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><p>&nbsp;</p></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><div align="center">Dengan ini adalah diperakukan bahawa<br /><em>This is to certify that</em></div></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><p>&nbsp;</p></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><div align="center"><h2><strong>'.strtoupper($row_cetak_akuan['ts_peserta_nama']).'</strong></h2></div></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><p>&nbsp;</p></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><div align="center">telah menghadiri<br /><em>has attended a</em></div></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><p>&nbsp;</p></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3">
		<div align="center">
			<h3><strong>KURSUS '.strtoupper($row_cetak_akuan['ts_kursus_nama']).'</strong></h3>
		</div>
	</td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><p>&nbsp;</p></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><div align="center">diadakan pada<br />
        <em>held from</em></div></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><p>&nbsp;</p></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><div align="center"><strong>'.date("d/m/Y",strtotime($row_cetak_akuan['ts_kursus_tarikh_mula'])).'</strong> hingga <strong>'.date("d/m/Y",strtotime($row_cetak_akuan['ts_kursus_tarikh_tamat'])).'</strong></div></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><div align="center"><strong>'.strtoupper($row_cetak_akuan['ts_kursus_lokasi']).'</strong></div></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="480px" colspan="3"><p>&nbsp;</p></td>
    <td width="10px">&nbsp;</td>
  </tr>
    <tr>
    <td width="10px">&nbsp;</td>
    <td width="230px"><div align="center"><img src="img/signature-p.jpg" alt="Sign here" width="191" height="73"/></div></td>
    <td width="20px">&nbsp;</td>
    <td width="230px"><div align="center"><img src="img/signature-kp.jpg" alt="Sign here" width="249" height="75"/></div></td>
    <td width="10px">&nbsp;</td>
  </tr>
  <tr>
    <td width="10px">&nbsp;</td>
    <td width="230px"><div align="center">Ramlah bt Md Isa<br />Pengarah<br />Pusat Perkhidmatan Teknikal<br />MARDI</div></td>
    <td width="20px">&nbsp;</td>
    <td width="230px"><div align="center">Datuk Dr. Abd Shukor bin Abd Rahman<br />Ketua Pengarah<br />Institut Penyelidikan dan Kemajuan<br />Pertanian Malaysia (MARDI)</div></td>
    <td width="10px">&nbsp;</td>
  </tr>
</table>';
// output the HTML content
$pdf->writeHTML($htmlcontent, true, 0, true, 0);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('sijil-'.strtoupper($row_cetak_akuan['ts_peserta_nama']).'.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
<?php
mysql_free_result($cetak_akuan);
?>