<?php

require_once("../library/conn.php");

$playerID = $_GET["playerID"];

if (empty($playerID)) {
	exit("Bad arguments");
}

error_log("Deleting player");

$con = conn::getDB();
mysqli_query($con, "DELETE FROM players WHERE playerID=\"" . $playerID . "\"");