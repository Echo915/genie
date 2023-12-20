<?php 
require_once "..//config.php";
require_once "models.php";

function validUser($connection, $email, $password, $mode="signup") {
    $sql = "SELECT * FROM tbl_user WHERE user_email = '$email'";
    $execution = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($execution)) {
        // Verifies if password matches hashed password in database
        if (password_verify($password, $row["user_password"])) {
            if ($mode == "login") {
                $_SESSION["user_id"] = $row["user_id"];
            }
            return true;
        }
    }

}

if (isset($_POST["signup-form"])){
    $formToken = $_POST["formToken"];

    if (!$formToken || $formToken !== $_SESSION["formToken"]){
        $username = $_POST["user-username"];
        $email = $_POST["user-email"];
        $password = $_POST["user-password"];
        $table = "tbl_user";

        if (!validUser($connection, $email, $password)){
            $signup_kwargs = array(
                "user_username" => $username,
                "user_email" => $email,
                "user_password" => password_hash($password, PASSWORD_DEFAULT) // Hashes password for security reasons
            );

            $new_signup = new Signup($connection, $table);
            $new_signup->add($signup_kwargs);
        } else {
            echo '<script>alert("User already exists. Log in instead!")</script>';
        }

        redirect("login-signup");

        $_SESSION["formToken"] = $formToken;
    }
} elseif (isset($_POST["login-form"])) {
    $email = $_POST["user-email"];
    $password = $_POST["user-password"];

    if (validUser($connection, $email, $password, $mode="login")) {
        redirect("homepage/");
    } else {
        echo "<script>document.getElementById('error-msg').innerHTML = <p>Invalid Username or Password!</p>;</script>";
    }
}
?>