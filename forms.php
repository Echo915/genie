<?php
    if (isset($_POST["note-form"])) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $status = "temporal";

        $sql = "INSERT INTO tbl_note SET
            title = '$title',
            content = '$content',
            status = '$status'
        ";

        // $connection = mysqli_connect("localhost", "root", "") or die(mysqli_error()); // Connects to database
        // $db_select = mysqli_select_db($connection, "genie"); // Selects database

        $excution = mysqli_query($connection, $sql) or die(mysqli_error()); // write form details into database
    } else {
        if (isset($_POST["schedule-form"])){
            $task = $_POST["task"];
            $time = $_POST["time"];

            $sql = "INSERT INTO tbl_schedule SET
                task = '$task',
                time = '$time',
            ";

            $excution = mysqli_query($connection, $sql);
        }
    }
?>