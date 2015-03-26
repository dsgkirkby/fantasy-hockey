<?php

/*
 * DB Connection refactor
 *
 * @author  Pat
 */
class conn {
  
  static function getDB() {
    $con = mysqli_connect("localhost", "root", "");
    if (!$con) {
      exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($con, 'utf-8');
    mysqli_select_db($con, "dobber");
    if (mysqli_select_db($con, "dobber") == FALSE) {
      exit('DB select failed for "dobber"!');
    }
    return $con;
  }

  static function getDBAlt($remote, $priv, $encode, $db) {
    $con = mysqli_connect($remote, $priv, "");
    if (!$con) {
      exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
    //set the default client character set 
    mysqli_set_charset($con, $encode);
    if (mysqli_select_db($con, $db) == FALSE) {
      exit('DB select failed for $db!');
    }
    return $con;
  }

}
