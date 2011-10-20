<?php

define("BASE_PATH",$_SERVER['DOCUMENT_ROOT']."/"."ts");
define('AUTHOR', 'E-Latihan');

require_once(BASE_PATH.'/tcpdf/tcpdf.php');

class MyPDF extends TCPDF {
  public $remove_header = 0;
  public $remove_footer = 0;
  
  function init() {
    // set document information
    $this->SetCreator(PDF_CREATOR);
    $this->SetAuthor(AUTHOR);
    $this->SetKeywords(AUTHOR);

    $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margins
    $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $this->SetHeaderMargin(PDF_MARGIN_HEADER);
    $this->SetFooterMargin(PDF_MARGIN_FOOTER);

    //set auto page breaks
    $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //set image scale factor
    $this->setImageScale(PDF_IMAGE_SCALE_RATIO); 

    //set some language-dependent strings
    //$this->setLanguageArray($l); 
    
    // remove default header/footer
    if ($this->remove_header) 
    $this->setPrintHeader(false);
    if ($this->remove_footer) 
    $this->setPrintFooter(false);
    
  }
}

?>
