<?php

require_once 'conn.php';

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

function dieIfNotAdmin() {
	if (!userIsAdmin()) {
		header('Location: main.php', true, 303);
		die();
	}
}

function logOut() {
	unset($_SESSION["username"]);
}

function userIsAdmin() {
	if (!empty($_SESSION["isAdmin"])) {
		return $_SESSION["isAdmin"];
	} else {
		$con = conn::getDB();
		$user = mysqli_query($con, "SELECT * FROM users where username=\"" . getUsername() . "\"");

		if ($user->num_rows < 1) {
			return FALSE;
		} else {
			if (mysqli_fetch_assoc($user)["is_admin"]) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
}

function userIsManagerOfLeague($leagueID) {
	$con = conn::getDB();
	$manager = mysqli_query($con, "SELECT * FROM manages WHERE leagueID=" . $leagueID);

	if ($manager->num_rows < 1 || !getUsername()) {
		return FALSE;
	} else {
		if (getUsername() == mysqli_fetch_assoc($manager)["username"]) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}