<?php

require_once("../library/conn.php");

$username = $_GET["username"];

if (empty($username)) {
	exit("Bad arguments");
}

error_log("Deleting user");

$con = conn::getDB();
mysqli_query($con, "DELETE FROM users WHERE username=\"" . $username . "\"");