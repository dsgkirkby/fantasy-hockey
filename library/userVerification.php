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
	$con = mysqli_connect("localhost", "root", "");
	if (!$con) {
	    exit('Connect Error (' . mysqli_connect_errno() . ') '
		    . mysqli_connect_error());
	}
	//set the default client character set 
	mysqli_set_charset($con, 'utf-8');
	mysqli_select_db($con, "dobber");

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
    $con = mysqli_connect("localhost", "root", "");
    if (!$con) {
	exit('Connect Error (' . mysqli_connect_errno() . ') '
		. mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($con, 'utf-8');
    mysqli_select_db($con, "dobber");
    
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