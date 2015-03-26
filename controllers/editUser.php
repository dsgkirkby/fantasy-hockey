<?php
require_once("../library/conn.php");
$username = $_GET["username"];
$password = $_GET["password"];
$email = $_GET["email"];
$is_admin = $_GET["is_admin"];

$con = conn::getDB();
$query = "UPDATE users SET "
	. "password=\"" . $password . "\","
	. "email=\"" . $email . "\","
	. "is_admin=" . $is_admin
	. " WHERE username=\"" . $username . "\"";

error_log($query);
$result = mysqli_query($con, $query);

header("location: ../web/viewUsers.php"
	. ($result ? "" : "?error=true"), true, 303);
