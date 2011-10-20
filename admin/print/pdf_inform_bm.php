<?php
require('fpdf.php');
// activate Output-Buffer:
ob_start();
//START-OF-PHP code
include("../Connections/ebantahan.php");
include("../includes/config.php");
include("inform_bm.php");

$First_Name = $_POST['First_Name2'];
$agency = $_POST['agency2'];
$type = $_POST['type2'];
$Address = $_POST['Address2'];
$address2 = $_POST['address'];
$city = $_POST['city2'];
$state = $_POST['state2'];
$postal_code = $_POST['postal_code2'];
$country = $_POST['country2'];
$ic = $_POST['ic2'];
$Phone_No = $_POST['Phone_No2'];
$fax = $_POST['fax2'];
$email = $_POST['email2'];
$propose_object = $_POST['propose_object2'];
$cp_page = $_POST['cp_page2'];
$cp_paragraph = $_POST['cp_paragraph2'];
$cp_table = $_POST['cp_table2'];
$cp_figure = $_POST['cp_figure2'];
//$cp_plan = $_POST['cp_plan'];
$propose_object_desc = $_POST['propose_object_desc2'];
$suggestion_desc = $_POST['suggestion_desc2'];
//$upload = $_POST['upload'];
$hearing_session = $_POST['hearing_session2'];
$form_type = $_POST['form_type2'];
$date = $_POST['date2'];
$time = $_POST['time2'];
$add_form = $_POST['add_form2'];

//END-OF-PHP code
// Output-Buffer in variable:
$htmlbuffer=ob_get_contents();
// delete Output-Buffer :
ob_end_clean();
require('html2fpdf.php');
$pdf=new HTML2FPDF('L','mm','postcard');
$pdf->AddPage();
$pdf->WriteHTML($htmlbuffer);
$pdf->Output(); //Outputs on browser screen
?>