<?php

require_once('../library/conn.php');


$playerID = $_GET["playerID"];
$teamID = $_GET["teamID"];

$con = conn::getDB();
$playerAssignDrop = "DELETE FROM player_assignments  where playerID=" . $playerID . " and teamID=" . $teamID ;
echo $playerAssignDrop;
$result = mysqli_query($con, $playerAssignDrop);

error_log($playerAssignDrop);

if ($result) {
   header("location: ../web/viewTeam.php", true, 303);
} else {
    header("location: ../web/viewTeam.php?error=true", true, 303);
}

