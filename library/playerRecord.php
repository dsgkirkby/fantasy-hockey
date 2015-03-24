<?php

/**
 * Record of a player's performance in a certain season, with a given team
 *
 * @author Dylan
 */
class playerRecord {
    public $player;
    public $team;
    public $season; 
    public $gamesPlayed;
    public $goals;
    public $hits;
    public $giveaways;
    public $takeaways;
    public $penalties_drawn;
    public $sacorsi;
    public $qot;
    public $qoc;
    public $ozs;
    public $toi;
    
    function __construct($playerRecord) {
	$this->player = $playerRecord["name"];
	$this->team = $playerRecord["teamName"];
	$this->season = $playerRecord["season"];
	$this->gamesPlayed = $playerRecord["gamesPlayed"];
	$this->goals = $playerRecord["goals"];
	$this->hits = $playerRecord["hits"];
	$this->giveaways = $playerRecord["giveaways"];
	$this->takeaways = $playerRecord["takeaways"];
	$this->penalties_drawn = $playerRecord["penalties_drawn"];
	$this->sacorsi = $playerRecord["sacorsi"];
	$this->qot = $playerRecord["qot"];
	$this->qoc = $playerRecord["qoc"];
	$this->ozs = $playerRecord["ozs"];
	$this->toi = $playerRecord["toi"];
    }
    
    static function getAllRecords() {
	$con = mysqli_connect("localhost", "root", "");
	if (!$con) {
	    exit('Connect Error (' . mysqli_connect_errno() . ') '
		    . mysqli_connect_error());
	}
	//set the default client character set 
	mysqli_set_charset($con, 'utf-8');
	mysqli_select_db($con, "dobber");
	
	$query = "SELECT * FROM players NATURAL JOIN plays_for";
	$playerRecords = mysqli_query($con, $query);
	
	$toReturn = [];
	
	foreach ($playerRecords as $pr) {
	    array_push($toReturn, new playerRecord($pr));
	}
	
	return $toReturn;
    }
    
    static function getNHLTeams() {
	$con = mysqli_connect("localhost", "root", "");
	if (!$con) {
	    exit('Connect Error (' . mysqli_connect_errno() . ') '
		    . mysqli_connect_error());
	}
	//set the default client character set 
	mysqli_set_charset($con, 'utf-8');
	mysqli_select_db($con, "dobber");
	
	$query = "SELECT * FROM nhl_teams";
	
	return mysqli_query($con, $query);
    }
    
    static function getSeasons() {
	$con = mysqli_connect("localhost", "root", "");
	if (!$con) {
	    exit('Connect Error (' . mysqli_connect_errno() . ') '
		    . mysqli_connect_error());
	}
	//set the default client character set 
	mysqli_set_charset($con, 'utf-8');
	mysqli_select_db($con, "dobber");
	
	$query = "SELECT * FROM seasons";
	
	return mysqli_query($con, $query);
    }
}
