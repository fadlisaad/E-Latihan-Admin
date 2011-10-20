<?php
require_once("../dompdf_config.inc.php");

$html = include("../www/test/arahan-pengeluaran-kursus.php");

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");

?>