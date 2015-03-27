<?php

require_once('../library/conn.php');

$playerID = $_GET["playerID"];
$teamName = $_GET["teamName"];
$season = $_GET["season"];

$con = conn::getDB();

$query = "INSERT INTO plays_for (playerID, teamName, season) values"
	. "(" . $playerID . ", \"" . $teamName . "\", \"" . $season . "\")";;

$result = mysqli_query($con, $query);

header("location: ../web/viewSeasonStats.php"
	. ($result ? "" : "?error=true"), true, 303);


