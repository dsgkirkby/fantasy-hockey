<?php

require_once('../library/conn.php');

$playerID = $_GET["playerID"];
$teamName = $_GET["team"];
$season = $_GET["season"];

if (empty($playerID) or empty($teamName) or empty($season)) {
	exit("Bad arguments");
}

$con = conn::getDB();
$query = "DELETE FROM plays_for WHERE "
		. "playerID=" . $playerID . " "
		. "and teamName=\"" . $teamName . "\" "
		. "and season=" . $season;
$result = mysqli_query($con, $query);

header("location: ../web/viewSeasonStats.php"
		. ($result ? "" : "?error=true"), true, 303);
