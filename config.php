<?php
ini_set("date.timezone", "Africa/Accra");
date_default_timezone_set("Africa/Accra");


function generateFormToken($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $length; $i++) {
      $randomIndex = mt_rand(0, strlen($characters) - 1);
      $randomCharacter = $characters[$randomIndex];
      $randomString .= $randomCharacter;
    }
  
    return $randomString;
  }

  
// There might be a need to catch errors that may result from connecting to database
$connection = mysqli_connect("localhost", "root", ""); // Connects to database 
$db_select = mysqli_select_db($connection, "genie"); // Selects database

?>  