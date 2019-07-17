<?php

// Submit Data to mySQL database
// Joost Wegman, based on example by Josh de Leeuw

// get connection from separate script
include('database_connect.php');

function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

// You should not need to edit below this line

function mysql_insert($table, $inserts) {
    $values = array_map('mysql_real_escape_string', array_values($inserts));
    $keys = array_keys($inserts);

    return mysql_query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
}

// get the table name
$tab = $_POST['table'];

// decode the data object from json
$trials = json_decode($_POST['json']);

// get the optional data (decode as array)
$opt_data = json_decode($_POST['opt_data'], true);
$opt_data_names = array_keys($opt_data);

var_dump($trials);

// for each element in the trials array, insert the row into the mysql table
for($i=0;$i<count($trials);$i++)
{
    $to_insert = (array)($trials[$i]);
    // add any optional, static parameters that got passed in (like subject id or condition)
    for($j=0;$j<count($opt_data_names);$j++){
        $to_insert[$opt_data_names[$j]] = $opt_data[$opt_data_names[$j]];
    }
    $result = mysql_insert($tab, $to_insert);
}

// confirm the results
if (!$result) {
    die('Invalid query: ' . mysql_error());
    debug_to_console('invalid query');
} else {
    print "successful insert!";
    debug_to_console('successful insert!');
}

?>