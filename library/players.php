<?php

/**
 * A fantasy league, containing an ID and a list of teams and their scores
 *
 * @author Pat -> stolen from Dylan
 */
require_once 'conn.php';

class players {

	private $playerID;
	private $name;
	private $hometown;
	private $height;
	private $weight;
	private $dob;

	function __construct($playerID) {
		$this->playerID =  $playerID;
		$con = conn::getDB();
		$query = "SELECT * FROM players WHERE playerID=" . $playerID;
		$player = mysqli_fetch_assoc(mysqli_query($con, $query));
		$this->name     =  $player["name"];
		$this->hometown =  $player["hometown"];
		$this->height   =  $player["height"];
		$this->weight   =  $player["weight"];
		$this->dob      =  $player["dob"];
	}

	function getPlayerId() {
		return $this->playerID;
	}
	function getName() {
		return $this->name;
	}
	function getHometown() {
		return $this->hometown;
	}
	function getHeight() {
		return $this->height;
	}
	function getWeight() {
		return $this->weight;
	}
	function getDob() {
		return $this->dob;
	}
}
