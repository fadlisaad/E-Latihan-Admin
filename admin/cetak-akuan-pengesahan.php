<?php
/**
 * Copyright 2009-2011 MARDI
 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
 * This file is part of MARDILMS.
 * The latest code can be found at http://elearn.mardi.gov.my/
 * 
 * Description : Cetak akuan pengesahan.
 */
error_reporting(0);
require_once('../login/auth.php');
require_once('../Connections/ts_kursus.php');

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
$query_cetak_akuan = sprintf("SELECT ts_kursus.ts_kursus_id, ts_kursus.ts_kursus_nama, ts_kursus.ts_kursus_lokasi, ts_kursus.ts_kursus_tarikh_mula, ts_kursus.ts_kursus_tarikh_tamat, ts_kursus.ts_kursus_harga, ts_kursus.ts_kursus_peta, ts_peserta.ts_peserta_nama, ts_peserta.ts_peserta_alamat FROM ts_kursus, ts_peserta, ts_invoice WHERE ts_kursus.ts_kursus_id = %s AND ts_peserta.ts_peserta_ID=%s AND ts_invoice.peserta_id=ts_peserta.ts_peserta_ID AND ts_invoice.kursus_id=ts_kursus.ts_kursus_id LIMIT 1", GetSQLValueString($colname_cetak_akuan, "int"),GetSQLValueString($colname2_cetak_akuan, "int"));
$cetak_akuan = mysql_query($query_cetak_akuan, $ts_kursus) or die(mysql_error());
$row_cetak_akuan = mysql_fetch_assoc($cetak_akuan);
$totalRows_cetak_akuan = mysql_num_rows($cetak_akuan);

require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('e-latihan');
$pdf->SetTitle('Surat Pengesahan Kehadiran');
$pdf->SetSubject('Program Kursus dan Latihan Teknikal, MARDI');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
$htmlcontent = '<table>
  <tr>
    <td>Tarikh:</td>
    <td colspan="2">'.date('d/m/Y').'</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>Kepada:</td>
    <td colspan="2"><strong>TIMBALAN PENGARAH<br />
  PROGRAM KURSUS &amp; LATIHAN TEKNIKAL<br />
      PUSAT PERKHIDMATAN TEKNIKAL MARDI<br />
      PETI SURAT 12301<br />
      PEJABAT POS BESAR<br />
      50774 KUALA LUMPUR</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><strong>Tel : 03-8943 7221/7238<br />
Faks : 03-89448 2216</strong></td>
  </tr>
  <tr>
    <td colspan="3">Tuan/Puan,</td>
  </tr>
  <tr>
    <td colspan="3"><strong>AKUAN PENGESAHAN PENERIMAAN TAWARAN KURSUS</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Saya <strong>'.strtoupper($row_cetak_akuan['ts_peserta_nama']).'</strong> dari <strong>'.strtoupper($row_cetak_akuan['ts_peserta_alamat']).'</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><strong>Menerima / Menolak</strong>* tawaran untuk mengikuti <strong>KURSUS '.strtoupper($row_cetak_akuan['ts_kursus_nama']).'</strong> yang akan diadakan di <strong>'.$row_cetak_akuan['ts_kursus_lokasi'].'</strong> pada <strong>'.date("d/m/Y",strtotime($row_cetak_akuan['ts_kursus_tarikh_mula'])).'</strong> hingga <strong>'.date("d/m/Y",strtotime($row_cetak_akuan['ts_kursus_tarikh_tamat'])).'</strong>. Dengan ini saya sertakan <strong>PESANAN KERAJAAN / WANG POS / BANKERS CHEQUE</strong> yang berjumlah<strong> RM '.$row_cetak_akuan['ts_kursus_harga'].'</strong> seorang di atas nama <strong>DANA PUSAT LATIHAN MARDI</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Sekian, terima kasih</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">(TANDATANGAN PEMOHON)</td>
  </tr>
  <tr>
    <td colspan="3">*potong mana yang tidak berkenaan</td>
  </tr>
</table>';

// output the HTML content
$pdf->writeHTML($htmlcontent, true, 0, true, 0);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('surat-pengesahan-'.strtoupper($row_cetak_akuan['ts_peserta_nama']).'.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+

mysql_free_result($cetak_akuan);
?>