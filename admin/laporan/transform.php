<?php
  if( isset($_REQUEST["value"]) )
  {
     $str = $_REQUEST["value"];
     $str = strtoupper($str);
     echo "$str";
  }
?>