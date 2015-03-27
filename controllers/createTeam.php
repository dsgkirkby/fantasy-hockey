<?php

require_once('../library/userVerification.php');
require_once('../library/conn.php');

session_start();

$leagueID = $_GET["leagueID"];
$teamName = $_GET["teamName"];

$con = conn::getDB();

$query = "INSERT INTO f_teams (name, username, season, leagueID) values "
		. "(\"" . $teamName  . "\", \"" . getUsername() . "\", \"2014\", " . $leagueID . ")";

$result = mysqli_query($con, $query);

if ($result) {
    header("location: ../web/viewTeam.php?teamID=" . mysqli_insert_id($con) . "&leagueID=" . $leagueID, true, 303);
} else {
    header("location: ../web/viewLeague.php?leagueID=" . $leagueID . "&error=true", true, 303);
}