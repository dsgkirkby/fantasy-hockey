<?php

/**
 * Record of a player's performance in a certain season, with a given team
 *
 * @author Dylan
 */

require_once 'conn.php';

class playerRecord {
    public $playerID;
    public $player;
    public $team;
	public $division;
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
        $this->playerID=$playerRecord["playerID"];
		$this->player = $playerRecord["name"];
		$this->team = $playerRecord["teamName"];
		$this->division = $playerRecord["divisionName"];
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
		$con = conn::getDB();
		$query = "SELECT * FROM players JOIN (plays_for JOIN "
			. "(nhl_teams NATURAL JOIN nhl_divisions) ON "
			. "plays_for.teamName=nhl_teams.teamName) ON players.playerID=plays_for.playerID";
		$playerRecords = mysqli_query($con, $query);
		$toReturn = [];

		foreach ($playerRecords as $pr) {
			array_push($toReturn, new playerRecord($pr));
		}

		return $toReturn;
	}
	
	static function getNHLTeams() {
		$con = $con = conn::getDB();	
		$query = "SELECT * FROM nhl_teams";
		return mysqli_query($con, $query);
	}
	
	static function getSeasons() {
		$con = conn::getDB();
		$query = "SELECT * FROM seasons";
		return mysqli_query($con, $query);
	}

	static function getAllPlayers() {
		$con = conn::getDB();
		$query = "SELECT * FROM players";
		return mysqli_query($con, $query);
	}
}
