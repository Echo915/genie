<?php
require_once '..//config.php';
require_once 'models.php';


class ScheduleController {
    public $model;   

    public function __construct($model) {
        $this->model = $model;
    }

    public function add_task($task, $time, $status = NULL) {
        $this->model->task = $task;
        $this->model->time = $time;
        $this->model->status = $status;

        $this->model->kwargs = array(
            "task" => $this->model->task,
            "time" => $this->model->time,
            "status" => $this->model->status
        );
        $this->model->add($this->model->kwargs);
    }
}

class RoutineItemController {
    public $model;   

    public function __construct($model) {
        $this->model = $model;
    }

    public function add_routine_item($routine_item_title, $routine_id, $ass_days, $deleted = 0) {
        $this->model->routine_title = $routine_item_title;
        $this->model->routine_id = $routine_id;
        $this->model->ass_days = $ass_days;

        $this->model->kwargs = array(
            "routine_item_title" => $this->model->routine_item_title,
            "routine_id" => $this->model->routine_id,
            "ass_days" => $this->model->ass_days
        );
        $this->model->add($this->model->kwargs);
    }
}

class RoutineController {
    public $model;   

    public function __construct($model) {
        $this->model = $model;
    }

    public function add_routine($routine_title, $deleted = 0) {
        $this->model->routine_title = $routine_title;
        $this->model->deleted = $deleted;

        $this->model->kwargs = array(
            "routine_title" => $this->model->routine_title
        );
        $this->model->add($this->model->kwargs);
    }
}

class NoteController {
    public $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function add_note($title, $content, $status = NULL) {
        $this->model->title = $title;
        $this->model->content = $content;
        $this->model->status = $status;

        $this->model->kwargs = array(
            "title" => $this->model->title,
            "content" => $this->model->content,
            "status" => $this->model->status
        );
        $this->model->add($this->model->kwargs);
    }
}

// Checks if a note form was posted and adds data to database
if (isset($_POST["note-form"])) {
    $formToken = $_POST["formToken"];

    if (!$_SESSION["formToken"] || $formToken !== $_SESSION["formToken"]){
        $title = $_POST["title"];
        $content = $_POST["content"];
        $table = "tbl_note";

        $note_kwargs = array(
            "title" => $title,
            "content" => $content,
        );
    
        $newNote = new Note($connection, $table); // New note object
        $newNote->add($note_kwargs);

        $_SESSION["formToken"] = $formToken;
    }
    
    // Checks if a schedule form was posted and adds its data to database
} else if (isset($_POST["schedule-form"])){
    $formToken = $_POST["formToken"];

    if (!$_SESSION["formToken"] || $formToken !== $_SESSION["formToken"]) {
        $task = $_POST["task"];
        $time = $_POST["time"];
        $table = "tbl_schedule";

        $schedule_kwargs = array(
            "task" => $task,
            "time" => $time,
        );

        $newTask = new Schedule($connection, $table);
        $newTask->add($schedule_kwargs);

        $_SESSION["formToken"] = $formToken;
    }

} else if (isset($_POST["routine-form"])){
    $formToken = $_POST["formToken"];

    if (!$_SESSION["formToken"] || $formToken !== $_SESSION["formToken"]) {
        $routine_group = $_POST["routine-group"];
        $routine_title = $_POST["routine-title"];
        $table = "tbl_routine";
        $ass_days = "";
        $ass_days_list = $_POST["ass_day"];

        foreach($ass_days_list as $ass_day) {
            $ass_days .= $ass_day . ", "; 
        }
        $ass_days.rtrim(", ");

        $sql = "SELECT * FROM $table WHERE routine_title = '$routine_group' ";
        $execution = mysqli_query($connection, $sql);

        // Checks if title exists in routine table in db
        if (mysqli_num_rows($execution) < 1) {
            $routine_kwargs = array(
                "routine_title" => $routine_group
            );

            $newRoutine = new Routine($connection, $table); // Creates new routine if not exist
            $newRoutine->add($routine_kwargs);

            $execution = mysqli_query($connection, $sql);
        }
        
        $row = mysqli_fetch_assoc($execution);
        $routine_id = $row["id"];

        $table = "tbl_routine_item";
        $routine_item_kwargs = array(
            "routine_item_title" => $routine_item_title,
            "routine_id" => $routine_id,
            "ass_days" => $ass_days
        );

        $newRoutineItem = new RoutineItem($connection, $table);
        $newRoutineItem->add($routine_item_kwargs);

        $_SESSION["formToken"] = $formToken;
    }
}
?>