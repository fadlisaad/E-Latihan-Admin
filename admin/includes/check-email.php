<?php
function check_email($email){
   if(@ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)){

       $url = substr(strrchr($email, "@"), 1);
       if (strstr($url, "/")) {
           $url = explode("/", $url, 2);
           $url[1] = "/".$url[1];
       } else {
           $url = array($url, "/");
       }
       $fh = @fsockopen($url[0], 80);
       if ($fh) {
           @fputs($fh,"GET ".$url[1]." HTTP/1.1\nHost:".$url[0]."\n\n");
           if (@fread($fh, 22) == "HTTP/1.1 404 Not Found") { return FALSE; }
           else { return TRUE;    }
       } else { return FALSE;}
   }else{
       return FALSE;
   }
}
?>