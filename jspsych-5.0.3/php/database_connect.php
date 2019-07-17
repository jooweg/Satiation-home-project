<?php

$servername = "localhost:3306";
$username = "OP3_subject";
$password = "9mO98o&f";
$databasename = "OP3_";

$dbc = mysql_connect($servername, $username, $password);
print_r($dbc);
mysql_select_db($databasename, $dbc);
echo("end");
?>