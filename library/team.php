<?php

/**
 * This object represents a fantasy team for the purposes of displaying within a league
 *
 * @author Dylan
 */

class team {
    public $id;
    public $teamName;
    public $ownerName;
    public $games;
    public $goals;
    public $hits;
    
    static function compareTeamScore($team1, $team2) {
	if (!($team1 instanceof team && $team2 instanceof team)) {
	    return 0;
	} else {
	    return $team2->getScore() - $team1->getScore();
	}
    }
    
    function getScore() {
	return $this->goals * 2 + $this->games * 0.1 + $this->hits;
    }
    
    function __construct($id, $teamName, $ownerName, $games, $goals, $hits) {
	$this->teamName = $teamName;
	$this->ownerName = $ownerName;
	$this->games = $games;
	$this->goals = $goals;
	$this->hits = $hits;
	$this->id = $id;
    }
}
