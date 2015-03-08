<?php

/*
 * User manipulations DB
 *
 * @author Pat
 */
class user {
    private $username;
    private $password;
    private $email;
    
    function __construct($username, $password, $email) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
    
    public function username_exists($new_username) {
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

    public function add_user($username) {
        $con = mysqli_connect("localhost", "root", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "dobber");
        
        if ($this->username_exists($this->username)) {
            echo "exists";
            return false;
        } else if (mysqli_query($con, "INSERT INTO users (username, password, email)"
            . " VALUES ('$this->username', '$this->password', '$this->email')")) {
            //added
            return true;
        } else {
            echo "failed";
            //not added
            return false;
        }
    }

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
}
/*
 * Description of league
 *
 * @author Eric
 *
class users {
     
    function __construct() {
       
    }
    
    function getUsers() {
        $con = mysqli_connect("localhost", "phpweb", "");
        if (!$con) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                   . mysqli_connect_error());
        }
        //set the default client character set 
        mysqli_set_charset($con, 'utf-8');
        mysqli_select_db($con, "test");
        $users = mysqli_query($con, "SELECT * from users");
        return $users;
    }
}*/