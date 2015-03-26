<?php

$playerID = $_GET["playerID"];

if (empty($playerID)) {
    exit("Bad arguments");
}

error_log("Deleting player");

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '
	   . mysqli_connect_error());
}
//set the default client character set 
mysqli_set_charset($con, 'utf-8');
mysqli_select_db($con, "dobber");
mysqli_query($con, "DELETE FROM players WHERE playerID=\"" . $playerID . "\"");