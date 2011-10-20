<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_ts_kursus = $_SERVER['SERVER'];
$database_ts_kursus = $_SERVER['DATABASE'];
$username_ts_kursus = $_SERVER['USERNAME'];
$password_ts_kursus = $_SERVER['PASSWORD'];
$ts_kursus = mysql_pconnect($hostname_ts_kursus, $username_ts_kursus, $password_ts_kursus) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_ts_kursus, $ts_kursus);
?>