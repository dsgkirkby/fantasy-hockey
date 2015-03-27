<?php

require_once("../library/conn.php");
$leagueID = $_GET["leagueID"];

if (empty($leagueID)) {
	exit("Bad arguments");
}

error_log("Deleting league");

$con = conn::getDB();
mysqli_query($con, "DELETE FROM f_leagues WHERE leagueID=\"" . $leagueID . "\"");