<?php

require_once('../library/userVerification.php');
session_start();

$maxSize = $_GET["maxSize"];
$name = $_GET["leagueName"];

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '
	    . mysqli_connect_error());
}
//set the default client character set 
mysqli_set_charset($con, 'utf-8');
if (mysqli_select_db($con, "dobber") == FALSE) {
    exit('DB select failed!');
}

$leagueInsert = "INSERT INTO f_leagues (name, max_size, date_created) values "
	. "(\"" . $name . "\"," . $maxSize . ",\"" . date("Y-m-d") . "\")";

$result = mysqli_query($con, $leagueInsert);

$leagueID = mysqli_insert_id($con);

$managerInsert = "INSERT INTO manages (username, leagueID) values "
	. "(\"" . getUsername() . "\", " . $leagueID . ")";

error_log($managerInsert);

mysqli_query($con, $managerInsert);

if ($result) {
    header("location: ../web/viewLeague.php?leagueID=" . $leagueID, true, 303);
} else {
    header("location: viewLeagues.php?error=true", true, 303);
}

