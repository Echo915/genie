<?php
require_once "..//parent-classes/models.php";

class Schedule extends Models {
    public $task;
    public $time;
    public $status;
}

class Note extends Models {
    public $title;
    public $content;
    public $status;
}

class Routine extends Models {
    public $routine_title;
    public $deleted;
}

class RoutineItem extends Models {
    public $routine_title;
    public $routine_id;
    public $ass_days;
}
?>