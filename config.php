<?php
// Sessions must always start at the very top of your php page
// If you are including the php file where the session starts, make sure you include it at the very top of the desired php file
session_start();

require_once "initialize.php";

ini_set("date.timezone", "Africa/Accra");
date_default_timezone_set("Africa/Accra");

function generateFormToken($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $length; $i++) {
      $randomIndex = mt_rand(0, strlen($characters) - 1); // Random number within the range of $character's length
      $randomCharacter = $characters[$randomIndex];
      $randomString .= $randomCharacter;
    }
  
    return $randomString;
  }

function redirect($url) {
  if (!empty($url)) {
    // Uses javascript to redirect the webpage to url specified by the user
    echo "<script>location.href='".BASE_URL.$url."'</script>";
  }
}

  
// There might be a need to catch errors that may result from connecting to database
$connection = mysqli_connect("localhost", "root", ""); // Connects to database 
$db_select = mysqli_select_db($connection, "genie"); // Selects database

?>  