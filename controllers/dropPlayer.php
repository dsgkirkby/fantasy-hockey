<?php

require_once('../library/conn.php');


$playerID = $_GET["playerID"];
$teamID = $_GET["teamID"];
$leagueID = $_GET["leagueID"];

$con = conn::getDB();
$playerAssignDrop = "DELETE FROM player_assignments  where playerID=" . $playerID . " and teamID=" . $teamID ;
echo $playerAssignDrop;
$result = mysqli_query($con, $playerAssignDrop);

error_log($playerAssignDrop);
echo "../web/viewTeam.php?leagueID=" . $leagueID . "&teamID=" . $teamID;
if ($result) {
   header("location: ../web/viewTeam.php?leagueID=" . $leagueID . "&teamID=" . $teamID , true, 303);
} else {
    header("location: ../web/viewTeam.php?error=true&leagueID=" . $leagueID . "&teamID=" . $teamID, true, 303);
}

