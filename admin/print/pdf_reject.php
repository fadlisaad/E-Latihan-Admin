<?php
require('fpdf.php');
// activate Output-Buffer:
ob_start();
//START-OF-PHP code
//include("../Connections/ebantahan.php");
require_once('../Connections/ebantahan.php');
include("../includes/config.php");
include("reject.php");
//END-OF-PHP code
// Output-Buffer in variable:
$htmlbuffer=ob_get_contents();
// delete Output-Buffer :
ob_end_clean();
require('html2fpdf.php');
$pdf=new HTML2FPDF();
$pdf->AddPage();
$pdf->WriteHTML($htmlbuffer);
$pdf->Output(); //Outputs on browser screen
?>