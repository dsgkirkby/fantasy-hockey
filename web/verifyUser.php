<?php

require_once('../library/userVerification.php');
require_once('../library/conn.php');

$username = $_GET["username"];
$password = $_GET["password"];
$newUser = $_GET["new"];

if (empty($username) || empty($password)) {
    exit("Username or Password empty");
}

$con = conn::getDB();
$user = mysqli_query($con, "select * from users where username=\"" . $username . "\" and password=\"" . $password . "\"");

if ($user->num_rows < 1) {
    header('Location: login.php?error=true', true, 303);
    die();
} else {
    session_start();
    $_SESSION["username"] = mysqli_fetch_assoc($user)["username"];
    $_SESSION["isAdmin"] = userIsAdmin();
    header('Location: main.php?new=' . $newUser, true, 303);
    die();
}