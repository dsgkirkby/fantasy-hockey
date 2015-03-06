<?php

/**
 * A fantasy league, containing an ID and a list of teams and their scores
 *
 * @author Dylan
 */

require_once 'team.php';
class league {
    private $leagueID;
    private $teams;
    
    function __construct($leagueID) {
        $this->leagueID = $leagueID;
    }
    
    function getTeams() {
        if (empty($teams)) {
	    $con = mysqli_connect("localhost", "root", "");
	    if (!$con) {
		exit('Connect Error (' . mysqli_connect_errno() . ') '
		       . mysqli_connect_error());
	    }
	    //set the default client character set 
	    mysqli_set_charset($con, 'utf-8');
	    mysqli_select_db($con, "dobber");
	    $teams = mysqli_query($con, "SELECT f_teams.teamID, f_teams.name, f_teams.username, player_assignments.score"
		    . " FROM f_teams INNER JOIN"
		    . " (SELECT teamID, SUM(points) as score from player_assignments group by teamID)"
		    . " player_assignments on f_teams.teamID = player_assignments.teamID"
		    . " WHERE f_teams.leagueID = " . $this->leagueID
		    . " ORDER BY player_assignments.score DESC");
	    
	    foreach ($teams as $team) {
		$this->teams[] = new team($team["name"], $team["username"], $team["score"], $team["teamID"]);
	    }
	}
	return $this->teams;
    }
    
    function getLeagueId() {
	return $this->leagueID;
    }
}
