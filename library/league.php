<?php

/**
 * A fantasy league, containing an ID and a list of teams and their scores
 *
 * @author Dylan
 */
require_once 'team.php';
require_once 'user.php';
require_once 'conn.php';

class league {

	private $leagueID;
	public $name;
	public $dateCreated;
	public $teams;
	public $maxSize;

	function __construct($leagueID) {
		$this->leagueID = $leagueID;
		$con = conn::getDB();
		$query = "SELECT * FROM f_leagues WHERE leagueID=" . $leagueID;
		$league = mysqli_fetch_assoc(mysqli_query($con, $query));
		$this->name = $league["name"];
		$this->dateCreated = $league["date_created"];
		$this->maxSize = $league["max_size"];
		$this->teams = array();
	}

	function getManagers(){
		$con = conn::getDB();
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
			$con = conn::getDB();
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
