<?php

/**
 * A fantasy league, containing an ID and a list of teams and their scores
 *
 * @author Pat -> stolen from Dylan
 */
require_once 'team.php';

class players {

    private $playerID;
    private $name;
    private $hometown;
    private $height;
    private $weight;
    private $dob;

    function __construct($playerID) {
        $this->playerID =  $playerID;
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }

        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "dobber");
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
