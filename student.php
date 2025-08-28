<?php
require_once "database.php";

class Student extends Database {
    protected $table = "students";

    public function addStudent($name, $course) {
        return $this->create($this->table, ["name" => $name, "course" => $course]);
    }

    public function getStudents() {
        return $this->read($this->table);
    }

    public function updateStudent($id, $name, $course) {
        return $this->update($this->table, ["name" => $name, "course" => $course], $id);
    }

    public function deleteStudent($id) {
        return $this->delete($this->table, $id);
    }
}
