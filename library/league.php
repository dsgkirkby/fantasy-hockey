<?php

/**
 * A fantasy league, containing an ID and a list of teams and their scores
 *
 * @author Dylan
 */
require_once 'team.php';

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
	    exit('Connect Error (' . mysqli_connect_errno() . ') '
		    . mysqli_connect_error());
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
            $query = "SELECT f_teams.teamID, f_teams.name, f_teams.username,"
		    . " player_assignments.totalgoals, player_assignments.totalassists FROM f_teams"
		    . " INNER JOIN (SELECT teamID, SUM(goals) as totalgoals,"
		    . " SUM(assists) as totalassists from player_assignments group by teamID)"
		    . " player_assignments on f_teams.teamID = player_assignments.teamID"
		    . " WHERE f_teams.leagueID = " . $this->leagueID;
	    $teams = mysqli_query($con, $query);

	    foreach ($teams as $team) {
		array_push($this->teams, new team($team["teamID"],
			$team["name"], $team["username"], $team["totalgoals"],
			$team["totalassists"]));
	    }
	}
	return $this->teams;
    }

    function getLeagueId() {
	return $this->leagueID;
    }

}
