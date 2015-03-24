<?php

$teamID = $_GET["teamID"];

if (empty($teamID)) {
    exit("Bad arguments");
}

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '
	   . mysqli_connect_error());
}
//set the default client character set 
mysqli_set_charset($con, 'utf-8');
mysqli_select_db($con, "dobber");
mysqli_query($con, "DELETE FROM player_assignments WHERE teamID=" . $teamID);
mysqli_query($con, "DELETE FROM f_teams WHERE teamID=" . $teamID);