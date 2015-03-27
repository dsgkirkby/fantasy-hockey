<?php

require_once('../library/userVerification.php');
require_once('../library/conn.php');
session_start();

$name = $_GET["name"];
$hometown = $_GET["hometown"];
$height = $_GET["height"];
$weight = $_GET["weight"];
$dob = $_GET["dob"];

$con = conn::getDB();
$userInsert = "INSERT INTO players (name, hometown, height, weight, dob) values "
	. "(\"" . $name . "\",\"" . $hometown . "\"," . $height . "," . $weight . ",\"" . $dob . "\")";

$result = mysqli_query($con, $userInsert);

error_log($userInsert);

if ($result) {
	header("location: ../web/viewPlayers.php", true, 303);
} else {
	header("location: ../web/viewPlayers.php?error=true", true, 303);
}

