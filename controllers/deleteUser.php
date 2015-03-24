<?php

$username = $_GET["username"];

if (empty($username)) {
    exit("Bad arguments");
}

error_log("Deleting user");

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '
	   . mysqli_connect_error());
}
//set the default client character set 
mysqli_set_charset($con, 'utf-8');
mysqli_select_db($con, "dobber");
mysqli_query($con, "DELETE FROM users WHERE username=\"" . $username . "\"");