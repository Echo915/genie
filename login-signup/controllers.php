<?php 
// Sessions must always start at the very top of your php page
// If you are including the php file where the session starts, make sure you include it at the very top of the desired php file
session_start();

require_once "..//config.php";

if (isset($_POST["signup-form"])){
    $formToken = $_POST["formToken"];

    if (!$formToken || $formToken !== $_SESSION["formToken"]){
        $signup_kwargs = array(
            "user_username" => $_POST["user-username"],
            "user_email" => $POST["user-email"],
            "user_password" => $POST["user-password"]
        );

        $new_signup = new Signup($connection, $signup_kwargs);

        $_SESSION["formToken"] = $formToken;
    }
}
?>