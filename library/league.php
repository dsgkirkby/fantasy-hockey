<?php

/**
 * A fantasy league, containing an ID and a list of teams and their scores
 *
 * @author Dylan
 */
require_once 'team.php';
require_once 'user.php';

class league {

	private $leagueID;
	public $name;
	public $dateCreated;
	public $teams;
	public $maxSize;

	function __construct($leagueID) {
		$this->leagueID = $leagueID;
		$con = mysqli_connect("localhost", "root", "");
		if (!$con) {
			exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		}
		//set the default client character set 
		mysqli_set_charset($con, 'utf-8');
		mysqli_select_db($con, "dobber");
		$query = "SELECT * FROM f_leagues WHERE leagueID=" . $leagueID;
		$league = mysqli_fetch_assoc(mysqli_query($con, $query));
		$this->name = $league["name"];
		$this->dateCreated = $league["date_created"];
		$this->maxSize = $league["max_size"];
		$this->teams = array();
	}

	function getManagers(){
		$con = mysqli_connect("localhost", "root", "");
		if (!$con) {
			exit('Connect Error (' . mysqli_connect_errno() . ') '
					. mysqli_connect_error());
		}
		//set the default client character set 
		mysqli_set_charset($con, 'utf-8');
		if (mysqli_select_db($con, "dobber") == FALSE) {
			exit('DB select failed!');
		}
		$query="SELECT username FROM manages"
				. " where leagueID=\"" . $this->leagueID . "\"";
		$users = mysqli_query($con, $query);
		$results = array();
		foreach ($users as $user) {
			array_push($results, new user($user["username"]));
		}
		return $results;
	}

	function getTeams() {
		if (empty($this->teams)) {
			$con = mysqli_connect("localhost", "root", "");
			if (!$con) {
			exit('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
			}
			//set the default client character set 
			mysqli_set_charset($con, 'utf-8');
			mysqli_select_db($con, "dobber");
				$query = "SELECT * FROM team_stats WHERE leagueID = " . $this->leagueID;
			$teams = mysqli_query($con, $query);

			foreach ($teams as $team) {
			array_push($this->teams, new team($team["teamID"],
				$team["name"], $team["username"], $team["totalGames"], $team["totalGoals"],
				$team["totalHits"]));
			}
		}
		return $this->teams;
	}

	function getLeagueId() {
		return $this->leagueID;
	}

}
