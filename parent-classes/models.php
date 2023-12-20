<?php
// Parent models for all models

class Models {
    private $db_conn;
    private $table;
    public $kwargs;

    public function __construct($db_conn, $table) {
        $this->db_conn = $db_conn;
        $this->table = $table;
    }

    // Adds a new task
    public function add($kwargs = array()) {
        $this->kwargs = $kwargs;
        $sql = "INSERT INTO $this->table SET";
        
        // Loops through all items in $kwargs and updates $sql statement
        foreach ($this->kwargs as $key => $value) {
            $sql .= " $key = '$value',";
        }
        $sql = rtrim($sql, ",");
        
        $execution = mysqli_query($this->db_conn, $sql); // Execution is done on the connection in db_conn
    }

    // Gets all schedule items from database
    public function get_all_objects() {
        $sql = "SELECT * FROM $this->table";
        $execution = mysqli_query($this->db_conn, $sql); // Executes sql statement
        $objects = mysqli_fetch_all($execution, MYSQLI_ASSOC); // Fetches all data in executed statement (MYSQLI_ASSOC fetches results as an associative array)
        return $objects;
    }
}
?>
