<?php
//check if this file isnt being accessed directly
 if (stristr(htmlentities($_SERVER['PHP_SELF']), "config.php")) {
	   header("Location:../index.php");
    die();
}
$siteName = 'online NYSC posting system';
$db_user = 'root';
$db_pass = '';
$db_host = 'localhost';
$db_name = 'nysc';
$con = mysql_connect($db_host,$db_user,$db_pass) or die(mysql_error());
$selectDB = mysql_select_db($db_name) or die(mysql_error());
$rows_per_page = 16;
$link_range = 2;
?>