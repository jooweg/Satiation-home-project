<?php

// Submit Data to mySQL database
// Josh de Leeuw, adjusted by Joost Wegman

// make connection to database
include('database_connect.php');

// get the table name
$tab = $_POST['table'];
// get the variables to post in the table
$session = $_POST['session'];
$csv = $_POST['csv'];

// insert CSV and subject/session info into table
/*$insert = "INSERT INTO OP3_data ('session','csv')
VALUES(
'$session'
,'$csv')";*/
$insert = "INSERT INTO `OP3_data` (session, csv) VALUES( '$session' , '$csv') ";

$result = mysql_query($insert);

// confirm the results
if (!$result) {
    print('Invalid query: ' . mysql_error());
} else {
    print "successful insert!";
}

// close the connection to the database
mysqli_close($dbc);

?>