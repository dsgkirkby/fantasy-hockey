<?php

require_once('../library/userVerification.php');
require_once('../library/conn.php');
session_start();

$username = $_GET["username"];
$password = $_GET["password"];
$email = $_GET["email"];
$is_admin = $_GET["is_admin"];

$con = conn::getDB();
$userInsert = "INSERT INTO players (playerID, password, email, is_admin) values "
	. "(\"" . $username . "\",\"" . $password . "\",\"" . $email . "\"," . $is_admin . ")";

$result = mysqli_query($con, $userInsert);

error_log($userInsert);

if ($result) {
	header("location: ../web/viewUsers.php", true, 303);
} else {
	header("location: ../web/viewUsers.php?error=true", true, 303);
}


