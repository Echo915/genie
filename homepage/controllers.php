<?php
// Sessions must always start at the very top of your php page
// If you are including the php file where the session starts, make sure you include it at the very top of the desired php file
session_start();

require_once 'models.php';
require_once "db-connection.php";

// Checks if a note form was posted and adds data to database
if (isset($_POST["note-form"])) {
    $formToken = $_POST["formToken"];

    if (!$_SESSION["formToken"] || $formToken !== $_SESSION["formToken"]){$title = $_POST["title"];
        $content = $_POST["content"];
        $status = "temporal";
    
        $newNote = new Note($connection); // New note object
        $newNote->add_note($title, $content, $status); // Adds new note object to database
    }
    
    // Checks if a schedule form was posted and adds its data to database
} else if (isset($_POST["schedule-form"])){
    $formToken = $_POST["formToken"];

    if (!$_SESSION["formToken"] || $formToken !== $_SESSION["formToken"]) {
        $task = $_POST["task"];
        $time = $_POST["time"];

        $newTask = new Schedule($connection);
        $newTask->add_task($task, $time);

        $_SESSION["formToken"] = $formToken;
    }
}
?>