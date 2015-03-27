<?php

require_once('../library/conn.php');

$playerID = $_GET["playerID"];
$teamID = $_GET["teamID"];

$con = conn::getDB();
$playerAssignInsert = "INSERT INTO player_assignments (playerID, teamID) values "
        . "(" . $playerID . "," . $teamID . ")";

$result = mysqli_query($con, $playerAssignInsert);

error_log($playerAssignInsert);

if ($result) {
    header("location: ../web/viewTeam.php?teamID=" . $teamID, true, 303);
} else {
    header("location: ../web/viewTeam.php?teamID=" . $teamID . "&error=true", true, 303);
}

