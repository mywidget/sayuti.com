<?php
$servername = "localhost";
$username = "sayutic1_neo";
$password = "Llbt=DEWVZH1";
$dbname = "sayutic1_neo";
$link=mysql_connect($servername,$username,$password);
$db = mysql_select_db($dbname,$link);
if(!$db) die("failed to connect to database.......");

?>