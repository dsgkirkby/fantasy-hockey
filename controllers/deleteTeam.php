<?php

require_once('../library/conn.php');

$teamID = $_GET["teamID"];

if (empty($teamID)) {
	exit("Bad arguments");
}

$con = conn::getDB();
mysqli_query($con, "DELETE FROM player_assignments WHERE teamID=" . $teamID);
mysqli_query($con, "DELETE FROM f_teams WHERE teamID=" . $teamID);