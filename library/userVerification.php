<?php

function getUsername() {
    if (empty($_SESSION["username"])) {
	return false;
    } else {
	return $_SESSION["username"];
    }
}

function dieIfNoUser() {
    if (!getUsername()) {
	header('Location: login.php', true, 303);
	die();
    }
}

function logOut() {
    unset($_SESSION["username"]);
}