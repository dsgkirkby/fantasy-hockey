<?php

require_once("../library/conn.php");

$playerID = $_GET["playerID"];
$name = $_GET["name"];
$hometown = $_GET["hometown"];
$height = $_GET["height"];
$weight = $_GET["weight"];
$dob = $_GET["dob"];

$con = conn::getDB();

$query = "UPDATE players SET "
	. "playerID=" . $playerID . ","
	. "name=\"" . $name . "\","
	. "hometown=\"" . $hometown . "\","
	. "height=" . $height . ","
	. "weight=" . $weight . ","
	. "dob=\"" . $dob . "\""
	. " WHERE playerID=" . $playerID;

error_log($query);
$result = mysqli_query($con, $query);

if ($result) {
    header("location: ../web/viewPlayers.php", true, 303);
} else {
    header("location: ../web/viewPlayers.php?error=true", true, 303);
}
