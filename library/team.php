<?php

/**
 * This object represents a fantasy team for the purposes of displaying within a league
 *
 * @author Dylan
 */
class team {
    public $teamName;
    public $ownerName;
    public $score;
    public $id;
    
    function __construct($teamName, $ownerName, $score, $id) {
	$this->teamName = $teamName;
	$this->ownerName = $ownerName;
	$this->score = $score;
	$this->id = $id;
    }
}
