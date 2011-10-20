<?php
require_once("../pdf/dompdf_config.inc.php");

$html = include("../pdf/www/test/arahan-pengeluaran-kursus.php");

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");
?>