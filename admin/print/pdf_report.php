<?php
require('fpdf.php');
// activate Output-Buffer:
ob_start();
//START-OF-PHP code
//include("../Connections/ebantahan.php");
require_once('../Connections/ebantahan.php');
include("../includes/config.php");
include("../jpgraph/category_graph_sector.php");

$First_Name = $_POST['First_Name'];
$agency = $_POST['agency'];
$type = $_POST['type'];
$Address = $_POST['Address'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$postal_code = $_POST['postal_code'];
$country = $_POST['country'];
$ic = $_POST['ic'];
$Phone_No = $_POST['Phone_No'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$propose_object = $_POST['propose_object'];                      
$cp_page = $_POST['cp_page'];
$cp_paragraph = $_POST['cp_paragraph'];
$cp_table = $_POST['cp_table'];
$cp_figure = $_POST['cp_figure'];
//$cp_plan = $_POST['cp_plan'];
$propose_object_desc = $_POST['propose_object_desc'];
$suggestion_desc = $_POST['suggestion_desc'];
//$upload = $_POST['upload'];
$hearing_session = $_POST['hearing_session'];
$form_type = $_POST['form_type'];
$date = $_POST['date'];
$time = $_POST['time'];
$add_form = $_POST['add_form'];

//END-OF-PHP code
// Output-Buffer in variable:
$htmlbuffer=ob_get_contents();
// delete Output-Buffer :
ob_end_clean();
require('html2fpdf.php');
//$pdf=new HTML2FPDF('L','mm',array(132,178));
//$pdf=new HTML2FPDF('L','mm','A5');
$pdf=new HTML2FPDF('P','mm','A4');
//$pdf=new FPDF();
$pdf->AddPage();

$pdf->WriteHTML($htmlbuffer);
$pdf->Output(); //Outputs on browser screen
?>