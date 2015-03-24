<?php

require_once('../library/userVerification.php');

$username = $_GET["username"];
$password = $_GET["password"];

if (empty($username) || empty($password)) {
    exit("Username or Password empty");
}

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '
	   . mysqli_connect_error());
}
//set the default client character set 
mysqli_set_charset($con, 'utf-8');
mysqli_select_db($con, "dobber");
$user = mysqli_query($con, "select * from users where username=\"" . $username . "\" and password=\"" . $password . "\"");

if ($user->num_rows < 1) {
    header('Location: login.php?error=true', true, 303);
    die();
} else {
    session_start();
    $_SESSION["username"] = mysqli_fetch_assoc($user)["username"];
    $_SESSION["isAdmin"] = userIsAdmin();
    header('Location: main.php', true, 303);
    die();
}