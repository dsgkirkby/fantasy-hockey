<?php

require_once('league.php');

/*
 * User manipulations DB
 *
 * @author Eric & Pat
 */
class user {
    private $username;
    private $password;
    private $email;
    
    function __construct($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    
    public static function usernameExists($new_username) {
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "dobber");
        $success = mysqli_query($con, "SELECT * FROM users WHERE username = $new_username");
        if ($success != "") {
            return true;
        } else {
            return false;
        }
    }

    function addUser($username) {
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "dobber");
        
        if ($this->usernameExists($this->username)) {
            return false;
        } else if (mysqli_query($con, "INSERT INTO users (username, password, email)"
            . " VALUES ('$this->username', '$this->password', '$this->email')")) {
            //added
            return true;
        } else {
            //not added
            return false;
        }
    }

    //Eric's less than perfect section
    function getUsers() {
        $con = mysqli_connect("localhost", "phpweb", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "test");
        $users = mysqli_query($con, "SELECT * FROM users");
        return $users;
    }

    function get() {
        $con = mysqli_connect("localhost", "root", "");
        $user = mysqli_query($con, "SELECT * from users WHERE username="
                . $this->username);
        return $user;
    }

    function manages(){
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        if (mysqli_select_db($con, "dobber") == FALSE) {
            exit('DB select failed!');
        }
        $query="SELECT leagueID FROM manages"
                . " where username=\"" . $this->username . "\"";
        $leagues = mysqli_query($con, $query);
        $results = array();
        foreach ($leagues as $league) {
            array_push($results, new league($league["leagueID"]));
        }
        return $results;
    }

    function myLeagues() {
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        if (mysqli_select_db($con, "dobber") == FALSE) {
            exit('DB select failed!');
        }
        $query="SELECT l.leagueID FROM"
                . " f_leagues l INNER JOIN f_teams t ON l.leagueID=t.leagueID INNER JOIN users u ON"
                . " t.username=u.username and u.username=\"" . $this->username . "\"";
        $leagues = mysqli_query($con, $query);
        $results = array();
        foreach ($leagues as $league) {
            array_push($results, new league($league["leagueID"]));
        }
        return $results;
    }

    function getUsername() {
        return $this->username;
    }
}
