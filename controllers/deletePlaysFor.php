<?php

$playerID = $_GET["playerID"];
$teamName = $_GET["team"];
$season = $_GET["season"];

if (empty($playerID) or empty($teamName) or empty($season)) {
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
$query = "DELETE FROM plays_for WHERE "
        . "playerID=" . $playerID . " "
        . "and teamName=\"" . $teamName . "\" "
        . "and season=" . $season;
$result = mysqli_query($con, $query);

header("location: ../web/viewSeasonStats.php"
        . ($result ? "" : "?error=true"), true, 303);
