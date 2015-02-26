<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of league
 *
 * @author Dylan
 */
class league {
    private $leagueID;
    
    function __construct($leagueID) {
        $this->leagueID = $leagueID;
    }
    
    function getTeams() {
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                   . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "dobber");
        $teams = mysqli_query($con, "SELECT f_teams.name, f_teams.username, player_assignments.score"
                . " FROM f_teams INNER JOIN"
                . " (SELECT teamName, SUM(points) as score from player_assignments group by teamname)"
                . " player_assignments on f_teams.name = player_assignments.teamname"
                . " WHERE f_teams.leagueID = " . $this->leagueID
                . " ORDER BY player_assignments.score DESC");
        return $teams;
    }
}
