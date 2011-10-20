<?php
require('../includes/pdf/fpdf.php');
require_once('../../Connections/ts_kursus.php'); 

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

mysql_select_db($database_ts_kursus, $ts_kursus);
$query_bayaran = "SELECT ts_topic.topic_id, ts_instructor.*, SUM(ts_topic.topic_rate*ts_topic.topic_hour) AS jumlah,ts_topic.topic_title, ts_topic.topic_rate, ts_topic.topic_hour FROM ts_instructor, ts_topic WHERE ts_instructor.instruct_name=ts_topic.topic_instructor GROUP BY ts_instructor.instruct_id";
$bayaran = mysql_query($query_bayaran, $ts_kursus) or die(mysql_error());
$row_bayaran = mysql_fetch_assoc($bayaran);
$totalRows_bayaran = mysql_num_rows($bayaran);

isset($startRow_bayaran)? $orderNum=$startRow_bayaran:$orderNum=0;

//Initialize the 3 columns and the total
$column_code = "";
$column_name = "";
$column_price = "";
$total = 0;

//For each row, add the field to the corresponding column
while($row_bayaran = mysql_fetch_array($bayaran))
{
    $code = $row_bayaran['instruct_id'];
    $name = substr($row_bayaran['instruct_name'],0,20);
    $real_price = $row_bayaran["instruct_salary"];
    $price_to_show = $row_bayaran['jumlah'];

    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_price = $column_price.$price_to_show."\n";

    //Sum all the Prices (TOTAL)
    $total = $total+$real_price;
}
mysql_close();

//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 20;
//Table position, under Fields Name
$Y_Table_Position = 26;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(45);
$pdf->Cell(20,6,'Kod',1,0,'L',1);
$pdf->SetX(65);
$pdf->Cell(100,6,'Nama Penceramah',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'Bayaran',1,0,'R',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(20,6,$column_code,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->MultiCell(100,6,$column_name,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(30,6,'RM '.$column_price,1,'R');
$pdf->SetX(135);
$pdf->MultiCell(30,6,'RM '.$total,1,'R');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$number_of_products=2;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_products)
{
    $pdf->SetX(45);
    $pdf->MultiCell(120,6,'',1);
    $i = $i +1;
}

$pdf->Output();
?>