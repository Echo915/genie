<?php
class Schedule {
    private $db_conn;

    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }

    public function add_task($task, $time, $status = NULL) {
        $sql = "INSERT INTO tbl_schedule SET
        task = '$task',
        time = '$time',
        status = '$status'
        ";

        $execution = mysqli_query($this->db_conn, $sql);
    }
}

class Note {
    private $db_conn;

    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }

    public function add_note($title, $content, $status=NULL) {
        $sql = "INSERT INTO tbl_note SET
        title = '$title',
        content = '$content',
        status = '$status'
        ";

        $execution = mysqli_query($this->db_conn, $sql);
    }
}
?>