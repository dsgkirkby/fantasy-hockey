<?php

require_once('league.php');
require_once('conn.php');

/*
 * User manipulations DB
 *
 * @author Eric & Pat
 */
class user {
	private $username;
	private $password;
	private $email;
	
	function __construct($username) {
		$this->username = $username;
	}
	
	static function usernameExists($new_username) {
		$con = conn::getDB();
		$success = mysqli_query($con, "SELECT * FROM users WHERE username = $new_username");
		return ($success == "" ) ? false : true ;
	}

	static function addUser($username, $password, $email) {
		$con = conn::getDB();		
		if (user::usernameExists($username)) {
			return false;
		} else if (mysqli_query($con, "INSERT INTO users (username, password, email)"
			. " VALUES ('$username', '$password', '$email')")) {
			return true;
		} else {
			return false;
		}
	}

	//Eric's less than perfect section
	static function getUsers() {
		$con = conn::getDB();
		$users = mysqli_query($con, "SELECT * FROM users");
		return $users;
	}

	function get() {
		$con = conn::getDB();
		$user = mysqli_query($con, "SELECT * from users WHERE username="
				. $this->username);
		return $user;
	}

	function manages(){
		$con = conn::getDB();
		$query="SELECT leagueID FROM manages"
				. " where username=\"" . $this->username . "\"";
		$leagues = mysqli_query($con, $query);
		$results = array();
		foreach ($leagues as $league) {
			array_push($results, new league($league["leagueID"]));
		}
		return $results;
	}

	function myLeagues() {
		$con = conn::getDB();
		$query="SELECT l.leagueID FROM"
				. " f_leagues l INNER JOIN f_teams t ON l.leagueID=t.leagueID INNER JOIN users u ON"
				. " t.username=u.username and u.username=\"" . $this->username . "\"";
		$leagues = mysqli_query($con, $query);
		$results = array();
		foreach ($leagues as $league) {
			array_push($results, new league($league["leagueID"]));
		}
		return $results;
	}

	function getUsername() {
		return $this->username;
	}
}
