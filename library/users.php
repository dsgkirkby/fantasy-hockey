<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * User manipulations DB
 *
 * @author Pat
 */
class user {
    private $username;
    private $password;
    private $email;
    
    function __construct($username) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
    
    function username_exists($new_username) {
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "dobber");
        $success = mysqli_query($con, "SELECT * FROM users WHERE username = '$this->username'");
        if ($success != "") {
            return true;
        } else {
            return false;
        }
    }

    function add_user($new_username) {
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "dobber");
        
        if (username_exists($new_username)) {
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
}
