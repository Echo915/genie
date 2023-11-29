<?php
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
?>  