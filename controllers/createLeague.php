<?php

require_once('../library/userVerification.php');
require_once('../library/conn.php');

session_start();

$maxSize = $_GET["maxSize"];
$name = $_GET["leagueName"];

$con = conn::getDB();

$leagueInsert = "INSERT INTO f_leagues (name, max_size, date_created) values "
	. "(\"" . $name . "\"," . $maxSize . ",\"" . date("Y-m-d") . "\")";

$result = mysqli_query($con, $leagueInsert);

$leagueID = mysqli_insert_id($con);

$managerInsert = "INSERT INTO manages (username, leagueID) values "
	. "(\"" . getUsername() . "\", " . $leagueID . ")";

error_log($managerInsert);

mysqli_query($con, $managerInsert);

if ($result) {
	header("location: ../web/viewleague.php?leagueID=" . $leagueID, true, 303);
} else {
	header("location: viewLeagues.php?error=true", true, 303);
}

