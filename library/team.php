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
    public $goals;
    public $assists;
    
    static function compareTeamScore($team1, $team2) {
	if (!($team1 instanceof team && $team2 instanceof team)) {
	    return 0;
	} else {
	    return $team2->getScore() - $team1->getScore();
	}
    }
    
    function getScore() {
	return $this->goals + $this->assists;
    }
    
    function __construct($id, $teamName, $ownerName, $goals, $assists) {
	$this->teamName = $teamName;
	$this->ownerName = $ownerName;
	$this->goals = $goals;
	$this->assists = $assists;
	$this->id = $id;
    }
}
