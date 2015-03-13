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
    
    if ($manager->num_rows < 1 || empty($_SESSION["username"])) {
	return FALSE;
    } else {
	if ($_SESSION["username"] == mysqli_fetch_assoc($manager)["username"]) {
	    return TRUE;
	} else {
	    return FALSE;
	}
    }
}