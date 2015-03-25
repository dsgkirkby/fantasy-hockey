<?php

$playerID = $_GET["playerID"];
$teamName = $_GET["teamName"];
$season = $_GET["season"];

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '
	    . mysqli_connect_error());
}
//set the default client character set 
mysqli_set_charset($con, 'utf-8');
mysqli_select_db($con, "dobber");

$query = "INSERT INTO plays_for (playerID, teamName, season) values"
	. "(" . $playerID . ", \"" . $teamName . "\", \"" . $season . "\")";;

$result = mysqli_query($con, $query);

header("location: ../web/viewSeasonStats.php"
	. ($result ? "?err=true" : ""), true, 303);


