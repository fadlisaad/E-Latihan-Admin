<?php
// REQUIRED! Parameters to connect to your DB
// CHANGE ONLY $db_host, $db_name, $username, $password
$db_host="202.190.32.26";
$db_name="mardilms";
$username="root";
$password="xs2mysql";

// DON'T CHANGE THE FOLLOWING CODE!
$db_con=mysql_connect($db_host,$username,$password);
$connection_string=mysql_select_db($db_name);
mysql_connect($db_host,$username,$password);
mysql_select_db($db_name);
?>