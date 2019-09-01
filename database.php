<?php 

date_default_timezone_set('Asia/Jakarta');
$server = "localhost";
$username = "root";
$password = "";
$database = "app_basic";
//echo "ok";
mysql_connect($server,$username,$password);
mysql_select_db($database);
?>